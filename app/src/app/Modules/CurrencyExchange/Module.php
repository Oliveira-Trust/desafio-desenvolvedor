<?php

namespace App\Modules\CurrencyExchange;

use App\Models\CurrencyExchangeLogs;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Auth;

class Module
{
    public static array $paymentMethods = ['bankSlip', 'creditCard'];

    private string $baseUrl = 'https://economia.awesomeapi.com.br/json';

    private string $originCurrency = 'BRL';
    private float $originCurrencyValue;
    private float $originCurrencyNetValue;

    private string $destinationCurrency;
    private float $convertedValue;

    private float $taxBasis = 3000;
    private float $conversionTax;
    private float $paymentTax;
    private array $taxes = [
        'lowerThanTaxisBasis' => 0.02,
        'higherOrEqualTaxisBasis' => 0.01,
        'bankSlip' => 0.0145,
        'creditCard' => 0.0763
    ];

    private string $paymentMethod;

    private array $pricing;

    public function __construct($originCurrencyValue, $destinationCurrency, $paymentMethod)
    {
        $this->guzzle = (new Client([
            RequestOptions::CONNECT_TIMEOUT => 5,
            RequestOptions::TIMEOUT => 5
        ]));

        $this->originCurrencyValue = $originCurrencyValue;
        $this->destinationCurrency = $destinationCurrency;
        $this->paymentMethod = $paymentMethod;
    }

    public function get(): object
    {
        return $this
            ->getPricing()
            ->applyTaxes()
            ->convert()
            ->log()
            ->format();
    }

    private function getPricing(): self
    {
        $response = $this->guzzle->request('GET', "$this->baseUrl/last/$this->originCurrency-$this->destinationCurrency");
        $body = json_decode($response->getBody(), true);
        $this->pricing = $body[$this->originCurrency . $this->destinationCurrency];
        return $this;
    }

    private function convert(): self
    {
        $this->convertedValue = $this->originCurrencyNetValue * $this->pricing['bid'];
        return $this;
    }

    private function applyTaxes(): self
    {
        $this->originCurrencyNetValue = $this->originCurrencyValue - $this->getConversionTax() - $this->getPaymentTax();
        return $this;
    }

    private function getConversionTax(): float
    {
        return $this->conversionTax = $this->originCurrencyValue < $this->taxBasis
            ? $this->originCurrencyValue * $this->taxes['lowerThanTaxisBasis']
            : $this->originCurrencyValue * $this->taxes['higherOrEqualTaxisBasis'];
    }

    private function getPaymentTax(): float
    {
        return $this->paymentTax = $this->originCurrencyValue * $this->taxes[$this->paymentMethod];
    }

    private function log(): self
    {
        $currencyExchangeLog = new CurrencyExchangeLogs();

        $currencyExchangeLog->user_id = Auth::user()->id;
        $currencyExchangeLog->origin_currency = $this->originCurrency;
        $currencyExchangeLog->destination_currency = $this->destinationCurrency;
        $currencyExchangeLog->origin_currency_value = $this->originCurrencyValue;
        $currencyExchangeLog->payment_method = $this->paymentMethod;
        $currencyExchangeLog->destination_currency_base_value = $this->pricing['bid'];
        $currencyExchangeLog->converted_value = $this->convertedValue;
        $currencyExchangeLog->payment_tax = $this->paymentTax;
        $currencyExchangeLog->conversion_tax = $this->conversionTax;
        $currencyExchangeLog->origin_currency_net_value = $this->originCurrencyNetValue;

        $currencyExchangeLog->save();

        return $this;
    }

    private function format(): object
    {
        return (object) [
            'originCurrency' => $this->originCurrency,
            'destinationCurrency' => $this->destinationCurrency,
            'originCurrencyValue' => $this->originCurrencyValue,
            'paymentMethod' => $this->paymentMethod,
            'destinationCurrencyBaseValue' => floatval($this->pricing['bid']),
            'convertedValue' => $this->convertedValue,
            'paymentTax' => $this->paymentTax,
            'conversionTax' => $this->conversionTax,
            'originCurrencyNetValue' => $this->originCurrencyNetValue
        ];
    }
}
