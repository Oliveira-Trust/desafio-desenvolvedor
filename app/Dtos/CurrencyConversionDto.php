<?php

namespace App\Dtos;

use App\Contracts\CurrencyConversionDtoContract;
use App\Enum\CurrencyEnum;
use App\Enum\PaymentMethodEnum;

class CurrencyConversionDto implements CurrencyConversionDtoContract
{
    protected int $paymentTax;

    protected int $conversionTax;

    protected int $convertableValue;

    protected int $convertableRate;

    protected int $convertedValue;

    public function __construct(
        protected CurrencyEnum $origin,
        protected CurrencyEnum $target,
        protected int $conversionValue,
        protected PaymentMethodEnum $paymentMethod,
    ) {
        $this->setConvertableValue($conversionValue);
    }

    public function getOrigin(): string
    {
        return $this->origin->value;
    }

    public function getTarget(): string
    {
        return $this->target->value;
    }

    public function getConversionValue(): int
    {
        return $this->conversionValue;
    }

    public function getPaymentMethod(): PaymentMethodEnum
    {
        return $this->paymentMethod;
    }

    public function setPaymentTax(int $value): self
    {
        $this->paymentTax = $value;

        return $this;
    }

    public function getPaymentTax(): int
    {
        return $this->paymentTax;
    }

    public function setConversionTax(int $value): self
    {
        $this->conversionTax = $value;

        return $this;
    }

    public function getConversionTax(): int
    {
        return $this->conversionTax;
    }

    public function setConvertableValue(int $value): self
    {
        $this->convertableValue = $value;

        return $this;
    }

    public function getConvertableValue(): int
    {
        return $this->convertableValue;
    }

    public function setConvertableRate(int $value): self
    {
        $this->convertableRate = $value;

        return $this;
    }

    public function getConvertableRate(): int
    {
        return $this->convertableRate;
    }

    public function setConvertedValue(int $value): self
    {
        $this->convertedValue = $value;

        return $this;
    }

    public function getConvertedValue(): int
    {
        return $this->convertedValue;
    }

    public function toArray(): array
    {
        return [
            'origin' => $this->getOrigin(),
            'target' => $this->getTarget(),
            'payment_method' => $this->getPaymentMethod()->value,
            'payment_method_tax' => $this->getPaymentTax(),
            'conversion_value' => $this->getConversionValue(),
            'conversion_tax' => $this->getConversionTax(),
            'convertable_value' => $this->getConvertableValue(),
            'convertable_rate' => $this->getConvertableRate(),
            'converted_value' => $this->getConvertedValue(),
        ];
    }
}
