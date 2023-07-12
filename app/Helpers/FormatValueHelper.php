<?php

namespace App\Helpers;

class FormatValueHelper
{
    /**
     * This method formats a monetary value for display in currency format.
     * @param float $value The value to be formatted.
     * @return string The formatted value as a string in currency format.
     */
     
    public static function formatCurrency(float $value): string
    {
        return number_format($value, 2, ',', '.');
    }
}
