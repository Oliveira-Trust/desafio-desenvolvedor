<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee',
        'fee_relative_amount',
        'conversion_fee_math_operator_id'
    ];

    public function conversionFeeMathOperator()
    {
        return $this->belongsTo(ConversionFeeMathOperator::class);
    }
}
