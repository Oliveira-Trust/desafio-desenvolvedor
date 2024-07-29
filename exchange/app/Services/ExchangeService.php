<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExchangeService
{
    private const BASE_API_URL = 'https://economia.awesomeapi.com.br/json/last/';

    /**
     * Fetch exchange rate values from the API.
     *
     * @param string $currencies Currency pair in the format 'DESTINATION-ORIGIN' (e.g., 'USD-BRL').
     * @return array Exchange rate data.
     * @throws \Exception If the API request fails.
     */
    public function fetchExchangeValues(string $currencies): array
    {
        $response = Http::withoutVerifying()->get(static::BASE_API_URL . $currencies);

        if ($response->status() !== 200) {
            throw new \Exception('Não foi possível buscar taxas de câmbio para ' . $currencies);
        }

        $data = json_decode($response->body(), true);

        return reset($data);
    }

    /**
     * Calculate the conversion applying business rules.
     *
     * @param float $amount The amount to be converted in BRL.
     * @param string $paymentMethod The method of payment.
     * @param array $exchangeRateData The exchange rate data.
     * @return array The result of the conversion with detailed calculations.
     */
    public function calculateConversion(float $amount, string $paymentMethod, array $exchangeRateData): array
    {
        $exchangeRate = floatval($exchangeRateData['bid']);
        $paymentMethodFee = $this->getPaymentMethodFee($paymentMethod);
        $conversionFee = $this->getConversionFee($amount);

        $paymentFeeAmount = $amount * $paymentMethodFee;
        $conversionFeeAmount = $amount * $conversionFee;

        $finalAmount = $amount - $paymentFeeAmount - $conversionFeeAmount;

        $convertedAmount = $finalAmount / $exchangeRate;

        return [
            'origin_currency' => 'BRL',
            'destination_currency' => $exchangeRateData['code'],
            'amount' => $amount,
            'payment_method' => $paymentMethod,
            'exchange_rate' => $exchangeRate,
            'converted_amount' => $convertedAmount,
            'payment_fee' => $paymentFeeAmount,
            'conversion_fee' => $conversionFeeAmount,
            'final_amount_for_conversion' => $finalAmount,
        ];
    }

    /**
     * Get the fee percentage for the specified payment method.
     *
     * @param string $paymentMethod The method of payment.
     * @return float The fee percentage for the payment method.
     * @throws \Exception If the payment method is not supported.
     */
    private function getPaymentMethodFee(string $paymentMethod): float
    {
        switch ($paymentMethod) {
            case 'ticket':
                return 0.0145;
            case 'credit_card':
                return 0.0763;
            default:
                throw new \Exception('Forma de pagamento não suportada.');
        }
    }

    /**
     * Get the conversion fee percentage based on the amount.
     *
     * @param float $amount The amount to be converted.
     * @return float The conversion fee percentage.
     */
    private function getConversionFee(float $amount): float
    {
        return $amount < 3000 ? 0.02 : 0.01;
    }
}
