<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_value',
        'fee_lower_value',
        'fee_higher_value'
    ];
}
