<?php

namespace App\Helpers;

use NumberFormatter;

class Currency
{
    public static function format($amount, $currency, $locale = 'pt_BR')
    {
        $fmt = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        return $fmt->formatCurrency($amount, $currency);
    }
}
