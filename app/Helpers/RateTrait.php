<?php

namespace App\Helpers;

use App\Enums\Rate;
use App\Enums\RateEnum;

trait RateTrait
{
    use MathTrait;

    private function calculateRatePayment(float $value, string $paymentMethod): float
    {
        $ratePayment = $this->getRatePayment($paymentMethod);

        return $this->calculatePercentage($value, $ratePayment);
    }

    private function getRatePayment(string $paymentMethod): float
    {
        $paymentMethods = [
            'bankSlip' => floatval(Rate::BANK_SLIP->value),
            'creditCard' => floatval(Rate::CREDIT_CARD->value)
        ];
        return $paymentMethods[$paymentMethod];
    }

    private function calculateRateConvert(float $value)
    {
        $rateConvert = $this->getRateConvert($value);
        return $this->calculatePercentage($value, $rateConvert);
    }

    private function getRateConvert($value): float
    {
        if ($value <= 3000) return floatval(Rate::COVERT_SMALLER->value);

        return floatval(Rate::COVERT_LARGER->value);
    }
}
