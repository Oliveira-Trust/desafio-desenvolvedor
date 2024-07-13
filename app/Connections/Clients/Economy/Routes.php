<?php

declare(strict_types=1);

namespace App\Connections\Clients\Economy;

use App\Enumerators\EconomyQuotation;

class Routes
{
    public const CURRENCY_TRANSLATIONS = 'json/available/uniq';
    public const COMBINATIONS = 'json/available';
    public const QUOTATION = 'json/last/';


    public static function currencyTranslations(): string
    {
        return self::getURI() . self::CURRENCY_TRANSLATIONS;
    }

    public static function combinations(): string
    {
        return self::getURI() . self::COMBINATIONS;
    }

    public static function quotation(string $currencies): string
    {
        return self::getURI() . self::QUOTATION . $currencies;
    }

    private static function getURI(): mixed
    {
        return config(EconomyQuotation::getPathApiURI(), '');
    }
}
