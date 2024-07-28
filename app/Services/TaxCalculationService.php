<?php

namespace App\Services;

class TaxCalculationService
{
    public function calculatePercentageOfValue(float $value, float $percentage): float
    {
        return $value * ($percentage / 100);
    }
}
