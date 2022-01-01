<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserConversionResponse extends Model
{
    use HasFactory;

    protected $table = 'user_conversion_responses';

    protected $fillable = [
        'user_conversion_id',
        'currency_value',
        'purchased_value',
        'pay_rate',
        'conversion_rate',
        'value_without_fees',
    ];
}
