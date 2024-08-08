<?php

namespace App\controllers;

use App\helpers\Currency;

class ConversionController
{
    public function convert(
        string $destinyCoin,
        float $amount,
        string $paymentMethod
    ): ?array
    {
        try {
            $currency = new Currency();

            return $currency->convertCurrency($destinyCoin, $amount, $paymentMethod);
        } catch (\Exception $e) {
            return null;
        }
    }
}