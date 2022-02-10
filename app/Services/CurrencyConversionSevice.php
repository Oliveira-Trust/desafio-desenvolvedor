<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConversionSevice
{

    public const PAYMENT_TAX = 72.50;
    public const CONVERSION_TAX = 50.00;

    public function listAllCurrencies()
    {
        $payload = Http::get("https://economia.awesomeapi.com.br/available/uniq");
        return $payload->json();
    }

    public function run(array $payload): bool|array
    {
        $isCurrencyCombinationValid = $this->isCurrencyCombinationValid($payload);

        if (!$isCurrencyCombinationValid) {
            return false;
        }

        $amountWithTaxes = $this->applyTaxes($payload);

        return [
            "bidOnConversion" => $this->getCurrentBid($payload),
            "convertedAmount" => $this->applyConversion($payload, $amountWithTaxes),
            "amountWithTaxes" => number_format($amountWithTaxes, 2) . " " . $payload['initial_currency']
        ];
    }

    public function getPaymentTax(): string
    {
        return number_format(self::PAYMENT_TAX, 2);
    }

    public function getConversionTax(): string
    {
        return number_format(self::CONVERSION_TAX, 2);
    }

    private function applyConversion(array $payload, float $amountWithTaxes): string
    {
        $request = Http::get("https://economia.awesomeapi.com.br/json/" . $payload['initial_currency'] . "-" . $payload['final_currency']);
        return number_format(($request->json())[0]['bid'] * $amountWithTaxes, 2) . " " . $payload['final_currency'];
    }

    private function getCurrentBid(array $payload)
    {
        return (Http::get("https://economia.awesomeapi.com.br/json/" . $payload['initial_currency'] . "-" . $payload['final_currency']))[0]['bid'];
    }

    private function applyTaxes(array $payload)
    {
        return $payload['amount_to_convert'] - self::PAYMENT_TAX - self::CONVERSION_TAX;
    }

    private function isCurrencyCombinationValid(array $payload): bool
    {
        $request = Http::get("https://economia.awesomeapi.com.br/available");
        return array_key_exists($payload['initial_currency'] . "-" . $payload['final_currency'], $request->json());
    }
}
