<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Arr;

class CurrencyPurchaseConversionFee extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'currency_purchase_id',
        'conversion_fee_id',
        'convertion_fee',
        'convertion_fee_value',
        'conversion_rule'
    ];

    public function currencyPurchase()
    {
        return $this->belongsTo(CurrencyPurchase::class);
    }

    public function conversionFee()
    {
        return $this->belongsTo(ConversionFee::class);
    }
}
