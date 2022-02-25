<?php

namespace App\Helpers;

trait  MathTrait
{
    public function calculatePercentage(float $value, float $percentage): float
    {
        return $value / 100 * $percentage;
    }

    private function calculateConvertCurrency(float $value, float $quote): float
    {
        return $value * $quote;
    }

    private function calculateValueBaseConvert(float $valueWithDiscount, float $valueTargetCurrency): float
    {
        return $valueWithDiscount / $valueTargetCurrency;
    }
}
