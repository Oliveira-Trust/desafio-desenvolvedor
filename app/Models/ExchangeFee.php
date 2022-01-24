<?php

namespace App\Models;

use App\Support\Money;
use Illuminate\Database\Eloquent\Model;

class ExchangeFee extends Model
{
    protected $guarded = [];

    public static function scopeGetFeeByAmount($query, int $amount)
    {
        return $query->where('min_amount', '<=', $amount)
            ->where('max_amount', '>=', $amount)
            ->first();
    }

    public function calculateFee(int $amount) : float
    {
        return (new Money($amount))->addFees($this->fees);
    }
}
