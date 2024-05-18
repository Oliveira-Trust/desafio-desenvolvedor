<?php

namespace App\Contracts;

use App\Enum\PaymentMethodEnum;

interface CurrencyConversionDtoContract
{
    public function getOrigin(): string;

    public function getTarget(): string;

    public function getConversionValue(): int;

    public function getPaymentMethod(): PaymentMethodEnum;

    public function setPaymentTax(int $value): self;

    public function getPaymentTax(): int;

    public function setConversionTax(int $value): self;

    public function getConversionTax(): int;

    public function setConvertableValue(int $value): self;

    public function getConvertableValue(): int;

    public function setConvertableRate(int $value): self;

    public function getConvertableRate(): int;

    public function setConvertedValue(int $value): self;

    public function getConvertedValue(): int;

    public function toArray(): array;
}
