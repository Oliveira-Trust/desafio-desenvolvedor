<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = ['payment_conversion_value',
                           'payment_conversion_min',
                           'payment_conversion_max',
                           'payment_rate_ticket',
                           'payment_rate_credit_card',
                           'coin_exchange_from'];
}
