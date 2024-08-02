<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyConversion extends Model
{
    use HasFactory;

    protected $table = 'currency_conversions';

    protected $with = ['payment_method'];
    protected $fillable = [
       
        'destination_currency',
        'value_conversion',
        'payment_method_id',
        'value_currency_conversion',
        'purchased_value_currency',
        'payment_rate',
        'conversion_rate',
        'amount_conversions_subtracting_fees',
        'user_id',
    ];

    public function payment_method(){
    
        return $this->belongsTo(PaymentMethod::class);
    }

    
}
