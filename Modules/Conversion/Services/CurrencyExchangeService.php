<?php

namespace Modules\Conversion\Services;

use Modules\Conversion\Exceptions\ConversionException;
use Modules\Conversion\Interfaces\CurrencyExchangeInterface;

class CurrencyExchangeService {

    public static function get(string $currencyOrigin, string $currencyDestiny): float {
        $currencyDestinyConversion = app(CurrencyExchangeInterface::class)->get($currencyOrigin, $currencyDestiny);

        if (!$currencyDestinyConversion) {
            throw new ConversionException();
        }

        return  $currencyDestinyConversion;
    }
}
