<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConversionSevice
{
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
            "amountWithTaxes" => number_format($amountWithTaxes, 2, ",", ".") . " " . $payload['initial_currency']
        ];
    }

    public function getTaxes(array $payload): array
    {
        $paymentTax = ((float)$payload['amount_to_convert']) * (7.63 / 100);
        if ((float)$payload['payment_method'] == 'bank_payment') {
            $paymentTax = ((float)$payload['amount_to_convert']) * (1.45 / 100);
        }

        $conversionTax = ((float)($payload['amount_to_convert']) * (2 / 100));
        if ($payload['amount_to_convert'] > 3000) {
            $conversionTax = ((float)($payload['amount_to_convert']) * (1 / 100));
        }

        return [
            'paymentTax' => number_format($paymentTax, 2, ",", "."),
            'conversionTax' => number_format($conversionTax, 2, ",", ".")
        ];
    }

    private function applyConversion(array $payload, float $amountWithTaxes): string
    {
        $request = Http::get("https://economia.awesomeapi.com.br/json/" . $payload['initial_currency'] . "-" . $payload['final_currency']);
        return number_format(($request->json())[0]['bid'] * $amountWithTaxes, 2, ",", ".") . " " . $payload['final_currency'];
    }

    private function getCurrentBid(array $payload)
    {
        return (Http::get("https://economia.awesomeapi.com.br/json/" . $payload['initial_currency'] . "-" . $payload['final_currency']))[0]['bid'];
    }

    private function applyTaxes(array $payload)
    {
        $amountToConvert = (float)$payload['amount_to_convert'];

        $amountWithTaxes = ($amountToConvert) + (($amountToConvert) * (2 / 100));
        if ($amountToConvert > 3000) {
            $amountWithTaxes = ($amountToConvert) + (($amountToConvert) * (1 / 100));
        }

        $bankPaymentTax = ($amountToConvert) * (1.45 / 100);
        $creditCardTax = ($amountToConvert) * (7.63 / 100);

        $amountWithTaxes -= $creditCardTax;
        if ($payload['payment_method'] == 'bank_payment') {
            $amountWithTaxes -= $bankPaymentTax;
        }

        return $amountWithTaxes;
    }

    private function isCurrencyCombinationValid(array $payload): bool
    {
        $request = Http::get("https://economia.awesomeapi.com.br/available");
        return array_key_exists($payload['initial_currency'] . "-" . $payload['final_currency'], $request->json());
    }
}
