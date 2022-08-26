<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionFeeMathOperator extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'description'
    ];

    public function conversionFees()
    {
        return $this->hasMany(ConversionFee::class);
    }
}
