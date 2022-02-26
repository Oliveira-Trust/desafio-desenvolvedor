<?php

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Helpers\RateTrait;
use App\Models\QuotationHistory;
use App\Models\User;

class CurrencyExchangeService
{
    use RateTrait;

    public function __construct(private CurrencyQuoteClientService $currencyQuoteClient, private QuotationHistory $quotationHistory)
    {
    }

    public function registerExchange(User $user, QuotationHistory $quotationHistory): void
    {
        $quote = $this->getQuote($quotationHistory->currency_origin, $quotationHistory->target_currency);
        $discountRates = $this->applyDiscountRates($quotationHistory->value_origin, $quotationHistory->payment_method);
        $valueWithDiscounts = $discountRates['valueWithDiscounts'];

        $valueTargetCurrency = $this->calculateConvertCurrency($valueWithDiscounts, $quote);

        $valueBaseConvert = $this->calculateValueBaseConvert($valueWithDiscounts, $valueTargetCurrency);

        $quotationHistory->value_origin_with_discount = $valueWithDiscounts;
        $quotationHistory->rate_payment = $discountRates['ratePayment'];
        $quotationHistory->rate_convert = $discountRates['rateConvert'];
        $quotationHistory->value_target_currency = $valueTargetCurrency;
        $quotationHistory->value_base_convert = $valueBaseConvert;

        $this->saveInHistory($user, $quotationHistory);
    }

    private function getQuote(string $currencyOrigin, string $targetCurrency): float
    {
        return $this->currencyQuoteClient->getLastAks($currencyOrigin, $targetCurrency);
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

    private function saveInHistory(User $user, QuotationHistory $quoteInfo): void
    {
        $user->quotationHistory()->save($quoteInfo);
    }
}
