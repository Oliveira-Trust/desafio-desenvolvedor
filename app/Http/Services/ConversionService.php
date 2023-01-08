<?php

namespace App\Http\Services;

use App\Enums\CurrencyOptionsEnum;
use App\Enums\PaymentTypsEnum;
use Illuminate\Support\Facades\Http;

class ConversionService
{
    public function conversion($request)
    {
        $currency = CurrencyOptionsEnum::fromName($request['currency']);
        $type = PaymentTypsEnum::fromName($request['type']);
        $conversionValue = $this->getCurrencyConversion($request['currency']);
        $paymentTypeMonetaryTaxValue = $this->paymentTypeMonetaryTaxValue($request['quantity'], $request['type']);
        $monetaryTaxValue = $this->monetaryTaxValue($request['quantity']);
        $totalConversion = $request['quantity']  - $paymentTypeMonetaryTaxValue - $monetaryTaxValue;
        $purchasedValue = $totalConversion / $conversionValue;

        return [
            'currency'              => $currency . " (${request['currency']})",
            'quantity'              => $request['quantity'],
            'type'                  => $type,
            'conversionValue'       => $request['currency'] . ' ' . number_format($conversionValue, '2', ',', '.'),
            'purchasedValue'        => $request['currency'] . ' ' . number_format($purchasedValue, '2', ',', '.'),
            'paymentTypeMonetaryTaxValue'   => number_format($paymentTypeMonetaryTaxValue, '2', ',', '.'),
            'monetaryTaxValue'      => number_format($monetaryTaxValue, '2', ',', '.'),
            'totalConversion'       => number_format($totalConversion, '2', ',', '.')
        ];
    }

    private function getCurrencyConversion(string $currency)
    {
        $response = Http::get("https://economia.awesomeapi.com.br/${currency}-BRL");

        return $response->collect()->first()['bid'];
    }

    private function paymentTypeMonetaryTaxValue(int $number, $type)
    {
        if ($type === 'TICKET') {
            return $number * (1.45 / 100);
        }

        return $number * (7.63 / 100);
    }

    private function monetaryTaxValue(int $number)
    {
        if ($number < 3000) {
            return $number * 2 / 100;
        }

        return $number * 1 / 100;
    }
}
