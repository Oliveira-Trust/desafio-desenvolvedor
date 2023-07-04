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
        'payment_method',
    ];

}
