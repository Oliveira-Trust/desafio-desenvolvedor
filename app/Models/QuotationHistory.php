<?php

namespace App\Models;

use App\Helpers\FormatsTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationHistory extends Model
{
    use HasFactory;
    use FormatsTrait;

    protected $fillable = [
        'currency_origin',
        'target_currency',
        'value_origin',
        'value_origin_with_discount',
        'rate_payment',
        'rate_convert',
        'value_target_currency',
        'value_base_convert',
        'payment_method',
        'user_id'
    ];

    protected function valueOrigin(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatCurrencyToBrl($value),
        );
    }

    protected function valueOriginWithDiscount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatCurrencyToBrl($value),
        );
    }

    protected function ratePayment(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatCurrencyToBrl($value),
        );
    }

    protected function rateConvert(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatCurrencyToBrl($value),
        );
    }

    protected function valueTargetCurrency(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatCurrencyToBrl($value, $this->target_currency),
        );
    }

    protected function valueBaseConvert(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->formatCurrencyToBrl($value),
        );
    }
}
