<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cotation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cotations';

    protected $fillable = [
        'origin_currency',
        'destination_currency',
        'conversion_amount',
        'payment_method',
        'currency_rate',
        'purchase_amount',
        'total_purchase_amount',
        'payment_fee',
        'conversion_fee',
        'amount_minus_fee',
    ];

    protected $dates = ['deleted_at'];
}