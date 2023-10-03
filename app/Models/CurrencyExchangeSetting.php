<?php

namespace App\Models;

use App\Enums\PaymentType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class CurrencyExchangeSetting extends Model
{
    use HasUlids;

    protected $table = 'currencies_exchange_settings';

    protected $fillable = [
        'boleto_payment_tax',
        'credit_card_payment_tax',
        'base_value_conversion_tax',
        'base_value_greater_conversion_tax',
        'base_value_lower_conversion_tax',
    ];

    protected $casts = [
        'boleto_payment_tax' => 'float',
        'credit_card_payment_tax' => 'float',
        'base_value_conversion_tax' => 'float',
        'base_value_greater_conversion_tax' => 'float',
        'base_value_lower_conversion_tax' => 'float',
    ];

    protected function boletoPaymentTax(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => formatPercentValue($value),
        );
    }

    protected function creditCardPaymentTax(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => formatPercentValue($value),
        );
    }

    protected function baseValueGreaterConversionTax(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => formatPercentValue($value),
        );
    }

    protected function baseValueLowerConversionTax(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => formatPercentValue($value),
        );
    }

    protected function baseValueConversionTax(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => formatCurrencyValue($value),
        );
    }

    public function getPaymentTax(PaymentType $paymentType): float {
        return match ($paymentType) {
            PaymentType::Boleto => $this->getRawOriginal('boleto_payment_tax'),
            PaymentType::CreditCard => $this->getRawOriginal('credit_card_payment_tax'),
            default => throw new InvalidArgumentException('Tipo de Pagamento inválido')
        };
    }

    public function getConversionTax(float $conversionValue): float {
        $baseValueConversionTax = $this->getRawOriginal('base_value_conversion_tax');

        return $conversionValue <= $baseValueConversionTax
            ? $this->getRawOriginal('base_value_lower_conversion_tax')
            : $this->getRawOriginal('base_value_greater_conversion_tax') ;
    }
}
