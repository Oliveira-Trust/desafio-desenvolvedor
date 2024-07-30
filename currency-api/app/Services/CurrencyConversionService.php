<?php

namespace App\Services;

use App\Models\ConversionFee;
use App\Models\PaymentMethod;
use App\Services\AwesomeAPI\AwesomeAPIService;
use App\Services\AwesomeAPI\Exceptions\CurrencyQuoteNotFoundException;

readonly class CurrencyConversionService
{
    function __construct(private AwesomeAPIService $awesomeAPIService) { }

    /**
     * Convert the given amount from BRL to the target currency applying the specified payment method fees and conversion fees.
     *
     * @param string $currencyTo
     * @param float $amount
     * @param string $paymentMethodCode
     * @return array
     * @throws \Exception
     */
    public function convert(string $currencyTo, float $amount, string $paymentMethodCode): array
    {
        if ($currencyTo === 'BRL') {
            throw new \Exception("Destination currency cannot be BRL.");
        }

        if ($amount < 1000 || $amount > 100000) {
            throw new \Exception("The amount must be between 1000 and 100000 BRL.");
        }

        $paymentFee = $this->getPaymentMethodFee($paymentMethodCode, $amount);
        $conversionFee = $this->getConversionFee($amount);

        try {
            $quote = $this->awesomeAPIService->getCurrencyQuote('BRL', $currencyTo);
        } catch (CurrencyQuoteNotFoundException $e) {
            throw new \Exception("Currency quote for {$currencyTo} not found.");
        }

        $totalWithFees = $amount - $paymentFee - $conversionFee;
        $convertedAmount = $totalWithFees / $quote->buyRate;

        return [
            'converted_amount' => $convertedAmount,
            'payment_fee' => $paymentFee,
            'conversion_fee' => $conversionFee,
            'total_with_fees' => $totalWithFees
        ];
    }

    /**
     * Get the payment method fee based on the amount.
     *
     * @param string $paymentMethodCode
     * @param float $amount
     * @return float
     * @throws \Exception
     */
    private function getPaymentMethodFee(string $paymentMethodCode, float $amount): float
    {
        if (!$paymentMethod = PaymentMethod::find($paymentMethodCode)) {
            throw new \Exception('Payment method not found.');
        }

        return $amount * $paymentMethod->fee / 100;
    }

    /**
     * Get the conversion fee based on the amount.
     *
     * @param float $amount
     * @return float
     * @throws \Exception
     */
    private function getConversionFee(float $amount): float
    {
        if (!$conversionFee = ConversionFee::active()->first()) {
            throw new \Exception('Conversion fee not found.');
        }

        // NOTE: O enunciado do desafio não deixa claro o que fazer quando a taxa for igual ao limite, portanto, optei por uma das opções
        $fee = $amount <= $conversionFee->amount_threshold
            ? $conversionFee->lower_than_threshold / 100
            : $conversionFee->greater_than_threshold / 100;

        return $amount * $fee;
    }
}
