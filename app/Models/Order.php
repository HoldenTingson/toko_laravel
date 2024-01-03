<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id',
        'discount',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function voucher()
    {
        return $this->hasOne(Voucher::class, 'order_id');
    }

    public function getVoucherCode()
{
    if ($this->voucher) {
        $voucher = $this->voucher;
        if ($voucher) {
            return $voucher->code;
        }
    }

    return '-';
}

    public function getCustomerName()
    {
        if($this->customer) {
            return $this->customer->first_name . ' ' . $this->customer->last_name;
        }
        return __('customer.working');
    }

    public function total()
    {
        return $this->items->map(function ($i){
            return $i->price;
        })->sum();
    }

    public function totalPrice()
    {
        return $this->items->map(function ($i){
            return $i->price;
        })->sum() - $this->discount;
    }

    public function formattedTotal()
    {
        return number_format($this->total(), 2);
    }

    public function formattedTotalPrice()
    {
        return number_format($this->total() - $this->discount, 2);
    }

    public function receivedAmount()
    {
        return $this->payments->map(function ($i){
            return $i->amount;
        })->sum();
    }

    public function formattedReceivedAmount()
    {
        return number_format($this->receivedAmount(), 2);
    }
}
