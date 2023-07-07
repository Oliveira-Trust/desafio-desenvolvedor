<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;
    protected $fillable = [
        'origin_currency',
        'destination_currency',
        'conversion_value',
        'converted_value',
        'payment_method_id',
        'user_id',
        'conversion_fee',
        'payment_tax',
        'total_amount_origin_currency',
        'total_amount_destination_currency',
    ];
}
