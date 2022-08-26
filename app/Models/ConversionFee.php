<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'percentage',
        'begin_amount',
    ];

    public function conversionFeeMathOperator()
    {
        return $this->belongsTo(ConversionFeeMathOperator::class);
    }
}
