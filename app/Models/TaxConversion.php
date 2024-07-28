<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxConversion extends Model
{
    use HasFactory;

    const DEFAULT_TAX_CONVERSION_ID = 1;
    protected $fillable = [
        'reference_value',
        'down_value_tax',
        'up_value_tax',
    ];
}
