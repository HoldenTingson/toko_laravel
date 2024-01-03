<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function index(Request $request) {
        $orders = new Order();
        if($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10);

        $total = $orders->map(function($i) {
            return $i->totalPrice();
        })->sum();
        $receivedAmount = $orders->map(function($i) {
            return $i->receivedAmount();
        })->sum();

        return view('orders.index', compact('orders', 'total', 'receivedAmount'));
    }

    public function store(OrderStoreRequest $request)
    {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
            'discount' => $request->discount,
        ]);

        $cart = $request->user()->cart()->get();
        foreach ($cart as $item) {
            $order->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'product_id' => $item->id,
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->cart()->detach();
        $order->payments()->create([
            'amount' => $request->amount - $request->discount,
            'user_id' => $request->user()->id,
        ]);
        return response()->json(['order_id' => $order->id, 'message' => 'success']);
    }

    public function invoice($id)
    {
        $data['order'] = Order::find($id);
        $pdf = \PDF::loadView('invoice.pdf', $data)->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        
        return $pdf->download('invoice.pdf');
    }
}

// order id, customer name, total price, amount, discount, received amount, status, to pay, created_at, voucher code