<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class CurrencyConversion extends Model
{
    /** @var string */
    protected $table = 'currency_conversions';

    /** @var array */
    protected $fillable = [
        'origin_currency',
        'destiny_currency',
        'value_currency',
        'form_payment',
        'value_destiny_currency',
        'payment_rate',
        'conversion_rate',
        'value_acquired_in_the_conversation',
        'value_used_for_conversion',
        'user_id'
    ];
}
