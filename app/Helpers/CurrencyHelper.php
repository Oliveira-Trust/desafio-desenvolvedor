<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function formatDecimalString($value): string
    {
        $floatValue = (float) $value;

        $valueAsString = (string) $value;

        $formattedValue = str_replace('.', ',', $valueAsString);

        return $formattedValue;
    }

    public static function formatCurrencyString(float $value): string
    {
        $formattedValue = number_format($value, 2, ',', '.');

        return $formattedValue;

    }

    public static function replaceDotWithComma(string $value): string
    {
        return str_replace('.', ',', $value);
    }

}

if (! function_exists('format_decimal_string')) {
    function format_decimal_string($value): string
    {
        return \App\Helpers\CurrencyHelper::formatDecimalString($value);
    }
}

if (! function_exists('format_float')) {
    function format_float(float $value): string
    {
        return \App\Helpers\CurrencyHelper::formatCurrencyString($value);
    }
}

if (! function_exists('replace_dot_with_comma')) {
    function replace_dot_with_comma(string $value): string
    {
        return \App\Helpers\CurrencyHelper::replaceDotWithComma($value);
    }
}
