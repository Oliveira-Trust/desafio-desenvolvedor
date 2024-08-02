<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionRate extends Model
{
    use HasFactory;

    protected $table = 'conversion_rate';
    protected $fillable = [
        "rate_greater_than",
        "rate_less_than",
        'currency_value'
    ];
}
