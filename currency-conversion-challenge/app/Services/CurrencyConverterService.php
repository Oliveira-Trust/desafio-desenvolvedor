<?php

namespace App\Services;

use GuzzleHttp\Client;

class CurrencyConverterService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function convertService($from, $to, $amountNoTaxes, $paymentMethod)
    {
        $conversionRate = $this->convertionRate($amountNoTaxes);
        $paymentRate = $this->paymentConditionsRates($amountNoTaxes, $paymentMethod);
        $amountTotal = $amountNoTaxes + $conversionRate + $paymentRate;

        $rate = $this->getConversionRate($from, $to);
        $convertedAmount = $amountTotal * $rate;

        $currencyValue = $this->getCurrencyValue($to, $from);

        return [
            'from' => $from,
            'to' => $to,
            'amount' => $amountNoTaxes + $conversionRate + $paymentRate,
            'payment_method' => $paymentMethod,
            'currency_value' => $currencyValue,
            'purchase_amount' => $convertedAmount,
            'conversion_rate' => $conversionRate,
            'payment_rate' => $paymentRate,
            'purchase_price_excluding_taxes' => $amountNoTaxes
        ];
    }

    public function convertionRate($amount)
    {
        $taxRate = $amount < 3000 ? 0.02 : 0.01;
        return $amount * $taxRate;
    }

    public function paymentConditionsRates($amount, $paymentMethod)
    {
        $paymentTaxRate = 0;

        if ($paymentMethod === 'boleto') {
            $paymentTaxRate = 0.0145;
        } elseif ($paymentMethod === 'credit_card') {
            $paymentTaxRate = 0.0763;
        } else {
            return response()->json([
                'error' => 'Método de pagamento não suportado. Use "Boleto" ou "Cartão de Crédito".'
            ], 400);
        }

        return $amount * $paymentTaxRate;
    }

    public function getConversionRate($from, $to)
    {
        
        try {
            $response = $this->client->get("https://economia.awesomeapi.com.br/json/last/{$from}-{$to}");
            $conversionData = json_decode($response->getBody(), true);
            $conversionRate = $conversionData["{$from}{$to}"]['bid'];

            return $conversionRate;
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Conversão indisponível. Tente novamente mais tarde.'
            ], 400);
        }
    }

    public function getCurrencyValue($from, $to){

        try {
            $response = $this->client->get("https://economia.awesomeapi.com.br/json/last/{$from}-{$to}");
            $conversionData = json_decode($response->getBody(), true);
            $conversionRate = $conversionData["{$from}{$to}"]['bid'];

            return (float) $conversionRate;
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Conversão indisponível. Tente novamente mais tarde.'
            ], 400);
        }
    }
}
