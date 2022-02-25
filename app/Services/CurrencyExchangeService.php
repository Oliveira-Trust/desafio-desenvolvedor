<?php

namespace App\Services;

use App\Enums\PaymentMethod;
use App\Helpers\RateTrait;
use App\Models\QuotationHistory;
use Illuminate\Support\Facades\Auth;

class CurrencyExchangeService
{
    use RateTrait;

    public function __construct(private CurrencyQuoteClientService $currencyQuoteClient, private QuotationHistory $quotationHistory)
    {
    }

    public function registerExchange(float $value, string $currencyOrigin, string $targetCurrency, string $paymentMethod): QuotationHistory
    {
        $quote = $this->getQuote($currencyOrigin, $targetCurrency);
        $discountRates = $this->applyDiscountRates($value, $paymentMethod);
        $valueWithDiscounts = $discountRates['valueWithDiscounts'];

        $valueTargetCurrency = $this->calculateConvertCurrency($valueWithDiscounts, $quote);

        $valueBaseConvert = $this->calculateValueBaseConvert($valueWithDiscounts, $valueTargetCurrency);

        $quotaInto = [
            'currency_origin' => $currencyOrigin,
            'target_currency' => $targetCurrency,
            'value_origin' => $value,
            'value_origin_with_discount' => $valueWithDiscounts,
            'rate_payment' => $discountRates['ratePayment'],
            'rate_convert' => $discountRates['rateConvert'],
            'value_target_currency' => $valueTargetCurrency,
            'value_base_convert' => $valueBaseConvert,
            'payment_method' => PaymentMethod::getView($paymentMethod)
        ];

        return $this->saveInHistory($quotaInto);
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

    private function saveInHistory(array $quoteInfo): QuotationHistory
    {
        $userId = Auth::user()->id;
        return $this->quotationHistory->create([...$quoteInfo, 'user_id' => $userId]);
    }
}
