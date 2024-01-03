<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'customer_id',
        'code',
        'amount',
        'is_used'
    ];

    public function getCustomerName()
{
    if ($this->customer_id) {
        $customer = $this->belongsTo(Customer::class, 'customer_id')->first();

        if ($customer) {
            return $customer->first_name . ' ' . $customer->last_name;
        }
    }

    return __('customer.working');
}

    public function formattedAmount()
    {
        return number_format($this->amount, 2);
    }
}
