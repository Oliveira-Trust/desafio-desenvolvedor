<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Services\CoinApiService;
use App\Services\HistoryConversionService;

class ConversionService
{
    private $historyConversionService;
    private $coinApiService;

    public function __construct()
    {
        $this->historyConversionService = new HistoryConversionService();
        $this->coinApiService = new CoinApiService();
    }

    public function convert($coin, $paymentMethod, $value, $sourceCoin)
    {
        $cotationResponse = $this->coinApiService->getLastCotation($coin, $sourceCoin);
        $responseName = strtoupper("{$coin}{$sourceCoin}");
        $actualCotation = round($cotationResponse->$responseName->bid,2);
        $paymentTax = $this->getTaxesByPayment($value, $paymentMethod);
        $conversionTax = $this->getConversionTaxes($value);
        $convertedValue = $this->calculateBoughtcoin($value, $conversionTax, $conversionTax, $actualCotation);

        $historyConversion = ['target_coin' =>  strtoupper($coin), 'source_coin' => $sourceCoin, 'conversion_tax' => $conversionTax,
            'payment_tax' => $paymentTax, 'actual_cotation' => $actualCotation,'converted_value' => $convertedValue,
            'payment_method' => $paymentMethod, 'value' => round($value, 2) ];

        $this->historyConversionService->create($historyConversion);

        return $historyConversion;
    }

    private function calculateBoughtcoin($value, $conversionTax, $paymentTax, $cotation)
    {
        $valueToConvert = $value - $conversionTax - $paymentTax;
        return $cotation < 0 ? round($valueToConvert * $cotation * -1 ,2) : round($valueToConvert / $cotation,2);
    }

    private function getTaxesByPayment($value, $paymentMethod)
    {
        switch ($paymentMethod) {
            case 'credit_card':
                return round($value * 0.0763,2);
            case 'bill':
                return round($value * 0.0763,2);
        }
    }

    private function getConversionTaxes(float $value)
    {
        return $value > 3000 ? round($value * 0.01,2) : round($value * 0.02,2);
    }
}
