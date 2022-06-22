<?php

namespace App\Services;

use App\Services\AwesomeApi\Service;
use Illuminate\Support\Arr;

class CurrencyService
{
    /**
     * @var Service
     */
    private $awesomeApi;

    /**
     * CurrencyService constructor.
     *
     */
    function __construct(Service $awesomeApi)
    {
        $this->awesomeApi = $awesomeApi;
    }

    /**
     * @return array
     * @throws AwesomeApi\Exceptions\AwesomeSDKException
     */
    public function getAvaliableCurrencies()
    {
        $avaliableCurrenciesApi = cache()->remember('avaliableCurrencies', 1440, function() {
            return $this->awesomeApi->getAvaliableCurrencies();
        });

        $avaliableCurrencies = [];

        foreach ($avaliableCurrenciesApi as $key => $name) {
            if (stripos($key, "-BRL") === false) {
                Arr::forget($avaliableCurrencies, $key);
                continue;
            }

            $code = str_replace("-BRL", "", $key);
            $avaliableCurrencies[$code] = $code;
        }

        return $avaliableCurrencies;
    }

    /**
     * @param $value
     * @param $currency
     * @param $paymentMethod
     * @return array
     * @throws AwesomeApi\Exceptions\AwesomeSDKException
     */
    public function calculeConversion($value, $currency, $paymentMethod)
    {
        $formattedValue = $this->getFormattedValue($value);
        $currencyQuote = round($this->awesomeApi->getCurrencyQuote($currency)['bid'], 2);

        if ($currency == 'BTC') {
            $currencyQuote = $currencyQuote * 1000;
        }

        $paymentFullFee = $this->getFullPaymentFee($formattedValue, $paymentMethod);
        $conversionFullFee = $this->getFullConversionFee($formattedValue);
        $valueToConvert = $formattedValue - ($paymentFullFee + $conversionFullFee);
        $convertedValue = round($valueToConvert / $currencyQuote, 2);

        return [
            'currency' => $currency,
            'paymentMethod' => $paymentMethod,
            'inputValue' => $formattedValue,
            'currencyQuote' => $currencyQuote,
            'paymentFullFee' => $paymentFullFee,
            'conversionFullFee' => $conversionFullFee,
            'valueToConvert' => $valueToConvert,
            'convertedValue' => $convertedValue
        ];
    }

    /**
     * @param $value
     * @param $paymentMethod
     * @return float|int
     */
    private function getFullPaymentFee($value, $paymentMethod)
    {
        $fee = config("payment_methods.{$paymentMethod}.fee");

        return round(($fee * $value) / 100, 2);
    }

    /**
     * @param $value
     * @return float|int
     */
    private function getFullConversionFee($value)
    {
        if ($value < 3000) {
            return round((2 * $value) / 100, 2);
        }

        return round((1 * $value) / 100, 2);
    }

    /**
     * @param $value
     * @return float|int
     */
    private function getFormattedValue($value)
    {
        return (float)preg_replace('/[^0-9]/', '', $value) / 100;
    }
}
