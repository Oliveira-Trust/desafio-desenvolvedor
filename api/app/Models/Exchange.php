<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'value',
        'method',
        'currency_from',
        'currency_to',
        'exchange_name',
        'exchange_date_time',
        'bid',
        'payment_method_rate_discount',
        'conversion_rate_discount',
        'discounted_value',
        'converted_value'
    ];
}
