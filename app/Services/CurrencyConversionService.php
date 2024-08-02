<?php

// app/Services/CurrencyConversionService.php
namespace App\Services;

use App\Enums\PaymentMethod;
use App\Models\ConversionRate;
use GuzzleHttp\Client;

class CurrencyConversionService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function convert(float $amount, string $targetCurrency, int $paymentMethodId): array
    {

        $exchangeRate = $this->getExchangeRate($targetCurrency);
        $paymentMethod = PaymentMethod::from($paymentMethodId);

        $paymentFee = $this->calculatePaymentFee($amount, $paymentMethod);
        $conversionFee = $this->calculateConversionFee($amount);

        $amountAfterFees = $amount - $paymentFee - $conversionFee;
        $convertedAmount = $amountAfterFees / $exchangeRate;


        $teste = [
            'exhangeRate' => $exchangeRate,
            'destination_currency' => $targetCurrency,
            'value_conversion' => $amount,
            'payment_method_id' => $paymentMethodId,
            'value_currency_conversion' => $exchangeRate,
            'purchased_value_currency' => $convertedAmount,
            'payment_rate' => $paymentFee,
            'conversion_rate' => $conversionFee,
            'amount_conversions_subtracting_fees' => $amountAfterFees,
            'user_id' => auth()->id()
        ];
        return $teste;
    }



    public function getExchangeRate($targetCurrency)
    {

        $response = $this->client->get("https://economia.awesomeapi.com.br/json/last/{$targetCurrency}-BRL");
        $data = json_decode($response->getBody(), true);
        $dataFormated = number_format((float) $data["{$targetCurrency}BRL"]['ask'], 2, '.', '');
        return $dataFormated;
    }

    public function calculatePaymentFee($amount, PaymentMethod $paymentMethod): float
    {
        $fee = $amount * $paymentMethod->getFee();

        return $fee;
    }

    public function calculateConversionFee($amount)
    {
        $conversionRate = ConversionRate::first();

        // Verifica se a taxa de conversão foi encontrada
        if (!$conversionRate) {
            throw new \Exception('Taxa de conversão não encontrada.');
        }

        // Define a taxa de conversão com base no valor do montante
        if ($amount < $conversionRate->currency_value) {
            $fee = $amount * $conversionRate->rate_less_than / 100;
        } else {
            $fee = $amount * $conversionRate->rate_greater_than / 100;
        }

        return $fee;
    }
}
