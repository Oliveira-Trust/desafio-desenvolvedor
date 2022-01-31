<?php

namespace ExchangeRate\Mappers;

use ExchangeRate\Models\Currency;
use ExchangeRate\Models\ExchangeRate;

final class ExchangeRateMapper
{
    private function __construct()
    {
    }

    public static function map(array $exchangeRate)
    {
        $exchangeRateObj = new ExchangeRate();

        if (isset($exchangeRate['create_date']))
            $exchangeRateObj->created_at = \DateTime::createFromFormat('Y-m-d H:i:s', $exchangeRate['create_date']);

        if (isset($exchangeRate['timestamp']))
            $exchangeRateObj->timestamp = \DateTime::createFromFormat('U', $exchangeRate['timestamp']);

        if (isset($exchangeRate['varBid']))
            $exchangeRateObj->varBid = is_numeric($exchangeRate['varBid']) ? (float)$exchangeRate['varBid'] : 0.0;

        if (isset($exchangeRate['pctChange']))
            $exchangeRateObj->pctChange = is_numeric($exchangeRate['pctChange']) ? (float)$exchangeRate['pctChange'] : 0.0;

        if (isset($exchangeRate['bid']))
            $exchangeRateObj->bid = is_numeric($exchangeRate['bid']) ? (float)$exchangeRate['bid'] : 0.0;

        if (isset($exchangeRate['high']))
            $exchangeRateObj->high = is_numeric($exchangeRate['high']) ? (float)$exchangeRate['high'] : 0.0;

        if (isset($exchangeRate['low']))
            $exchangeRateObj->low = is_numeric($exchangeRate['low']) ? (float)$exchangeRate['low'] : 0.0;

        if (isset($exchangeRate['ask']))
            $exchangeRateObj->ask = is_numeric($exchangeRate['ask']) ? (float)$exchangeRate['ask'] : 0.0;

        if (isset($exchangeRate['code']))
            $exchangeRateObj->from = (string)$exchangeRate['code'];

        if (isset($exchangeRate['codein']))
            $exchangeRateObj->to = (string)$exchangeRate['codein'];

        if (isset($exchangeRate['name']))
            $exchangeRateObj->name = (string)$exchangeRate['name'];
        if (isset($exchangeRate['name']))
            $exchangeRateObj->name = (string)$exchangeRate['name'];
        return $exchangeRateObj;
    }
}
