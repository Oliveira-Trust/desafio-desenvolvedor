<?php

namespace ExchangeRate\Mappers;

use ExchangeRate\Models\Currency;

final class CurrenciesMapper
{
    private function __construct(){}
    public static function map(array $currencies){
        $currenciesObjects = [];
        foreach ($currencies as $code => $name){
            $currenciesObjects[$code] = new Currency($code, $name);
        }
        return $currenciesObjects;
    }
}
