<?php

namespace ExchangeRate;

use ExchangeRate\Models\ExchangeRate;
use ExchangeRate\Providers\ExchangeRateResourceProvider;

final class ClientExchange
{
    private function __construct()
    {

    }

    /**
     * @param string $from
     * @param string $to
     * @return ExchangeRate|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getExchangeRate(string $from, string $to)
    {
        $provider = ExchangeRateResourceProvider::getInstance();
        return $provider->getExchangeRate($from, $to);
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getCurrenciesList()
    {
        $provider = ExchangeRateResourceProvider::getInstance();
        return $provider->getCurrenciesList();
    }

    /**
     * @param string $currency
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function isValidCurrency(string $currency)
    {
        $currencies = self::getCurrenciesList();
        return array_key_exists($currency, $currencies);
    }
}
