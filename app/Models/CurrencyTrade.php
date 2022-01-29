<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyTrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount_brl', 
        'amount', 
        'currency', 
        'user_id', 
        'payment_method_id', 
        'payment_method_fee',
        'amount_fee',
        'currency_rate',
        'payment_method_fee_value',
        'amount_fee_value',
    ];

    public function paymentMethod()
    {
        return $this->hasOne(PaymentMethod::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
