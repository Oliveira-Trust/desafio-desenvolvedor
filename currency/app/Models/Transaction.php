<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $fillable = [
        'invoice_id',
        'user_id',
        'origin_currency',
        'destination_currency',
        'amount_in_cents',
        'payment_method',
        'payment_fee',
        'conversion_fee',
        'converted_amount',
        'value_of_used_currency',
        'value_of_destination_currency',
    ];
}
