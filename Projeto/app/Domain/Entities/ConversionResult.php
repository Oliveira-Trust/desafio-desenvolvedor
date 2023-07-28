<?php
// app/Domain/Entities/ConversionResult.php

namespace App\Domain\Entities;

class ConversionResult
{
    public $originCurrency;
    public $targetCurrency;
    public $convertedAmount;
    public $conversionFee;
    public $paymentMethodFee;
    public $totalFee;
    public $initialAmount;

    public function __construct($originCurrency, $targetCurrency, $convertedAmount, $conversionFee, $paymentMethodFee, $totalFee, $initialAmount)
    {
        $this->originCurrency = $originCurrency;
        $this->targetCurrency = $targetCurrency;
        $this->convertedAmount = $convertedAmount;
        $this->conversionFee = $conversionFee;
        $this->paymentMethodFee = $paymentMethodFee;
        $this->totalFee = $totalFee;
        $this->initialAmount = $initialAmount;
    }
}
