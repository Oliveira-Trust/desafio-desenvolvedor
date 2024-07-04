<?php

namespace App\DTO;

class CreateExchangeDTO
{
    public float $value;
    public string $paymentMethod, $baseCurrency, $targetCurrency;

    public function __construct(
        float $value,
        string $paymentMethod,
        string $baseCurrency,
        string $targetCurrency
    ) {
        $this->value = $value;
        $this->paymentMethod = $paymentMethod;
        $this->baseCurrency = $baseCurrency;
        $this->targetCurrency = $targetCurrency;
    }
}
