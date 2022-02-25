<?php

namespace App\Helpers;

class StringHelpers
{
    public static function formatValue(string $amount): float
    {
        $cleanString = preg_replace('/([^0-9\.,])/i', '', $amount);
        $onlyNumbersString = preg_replace('/([^0-9])/i', '', $amount);

        $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

        $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
        $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '',  $stringWithCommaOrDot);

        return floatval(str_replace(',', '.', $removedThousandSeparator));
    }
}