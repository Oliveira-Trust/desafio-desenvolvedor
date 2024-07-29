<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'origin_currency',
        'destination_currency',
        'amount',
        'payment_method',
        'exchange_rate',
        'converted_amount',
        'payment_fee',
        'conversion_fee',
        'final_amount_for_conversion',
    ];
}
