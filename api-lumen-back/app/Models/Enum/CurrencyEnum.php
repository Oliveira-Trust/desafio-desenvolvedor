<?php

namespace App\Models\Enum;

class CurrencyEnum
{
    const BRL = 'BRL';
    const USD = 'USD';
    const EUR = 'EUR';
    const BTC = 'BTC';

    public static function fromKey(string $key = '')
    {
        switch ($key) {
            case self::USD:
                return self::USD;
                break;
            case self::EUR:
                return self::EUR;
                break;
            case self::BTC:
                return self::BTC;
                break;

            default:
                return self::BRL;
                break;
        }
    }
}

