<?php

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Helpers\RateTrait;

class CurrencyExchangeService
{
    use RateTrait;

    public function __construct(private CurrencyQuoteClientService $currencyQuoteClient)
    {
    }

    public function calculateExchange(float $value, string $currencyOrigin, string $targetCurrency, string $paymentMethod)
    {
        $quote = $this->getQuote($currencyOrigin, $targetCurrency);
        $discountRates = $this->applyDiscountRates($value, $paymentMethod);
        $valueWithDiscounts = $discountRates['valueWithDiscounts'];

        $valueTargetCurrency = $this->calculateConvertCurrency($valueWithDiscounts, $quote);

        $valueBaseConvert = $this->calculateValueBaseConvert($valueWithDiscounts, $valueTargetCurrency);

        return [
            'currencyOrigin' => $currencyOrigin,
            'targetCurrency' => $targetCurrency,
            'valueOrigin' => $value,
            'valueOriginWithDiscount' => $valueWithDiscounts,
            'ratePayment' => $discountRates['ratePayment'],
            'rateConvert' => $discountRates['rateConvert'],
            'valueTargetCurrency' => $valueTargetCurrency,
            'valueBaseConvert' => $valueBaseConvert,
            'paymentMethod' => PaymentMethod::getView($paymentMethod)
        ];
    }

    private function getQuote(string $currencyOrigin, string $targetCurrency): float
    {
        return $this->currencyQuoteClient->getLastQuote($currencyOrigin, $targetCurrency);
    }

    private function applyDiscountRates(float $value, string $paymentMethod): array
    {
        $ratePayment = $this->calculateRatePayment($value, $paymentMethod);
        $rateConvert = $this->calculateRateConvert($value);

        return [
            'ratePayment' => $ratePayment,
            'rateConvert' => $rateConvert,
            'valueWithDiscounts' => $value - $ratePayment - $rateConvert
        ];
    }
}
