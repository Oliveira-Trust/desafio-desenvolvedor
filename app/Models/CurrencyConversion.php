<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyConversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversion_value',
        'payment_type',
        'source_currency',
        'target_currency',
        'value_target_currency',
        'value_payment_fee',
        'value_conversion_fee',
        'purchased_value',
        'value_conversion_deductiong_fee',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
