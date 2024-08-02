<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'amount',
        'payment_method',
        'currency_value',
        'purchase_amount',
        'conversion_rate',
        'payment_rate',
        'purchase_price_excluding_taxes',
    ];
}
