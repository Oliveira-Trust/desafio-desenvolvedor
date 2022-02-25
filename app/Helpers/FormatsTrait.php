<?php

namespace App\Helpers;

use App\Enums\Format;

trait FormatsTrait
{
    private function formatCurrencyToBrl(float $value, string $prefix = 'BRL'): string
    {
        return "{$prefix} " . number_format($value, Format::DECIMAL_PLACE->value, ',', '');
    }

    private function formatCurrencyBrlToDecimal(string $value): string
    {
        $removeDot = str_replace(".", "", $value);
        $replaceDotToComma = str_replace(",", ".", $removeDot);

        return number_format($replaceDotToComma, Format::DECIMAL_PLACE->value, '.', '');
    }
}
