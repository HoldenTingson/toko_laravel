<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherStoreRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class VoucherController extends Controller
{
    public function index(Request $request) {
        $vouchers = new Voucher();
        if($request->start_date) {
            $vouchers = $vouchers->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $vouchers = $vouchers->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $vouchers = $vouchers->latest()->paginate(10);

        return view('vouchers.index', compact('vouchers'));
    }

    public function store(VoucherStoreRequest $request)
    {
        $code = substr(Uuid::uuid4()->toString(), 0, 5);
        Voucher::create([
            'customer_id' => $request->customer_id,
            'code' => $code,
            'order_id' => $request->order_id,
            'amount' => $request->amount,
        ]);
        return 'success';
    }

    public function used(Request $request)
{
    $voucher = Voucher::find($request->voucher_id);

    if ($voucher) {
        $voucher->update([
            'is_used' => true, 
        ]);

    } else {
        return response()->json(['message' => 'Voucher not found'], 404);
    }
}

}
