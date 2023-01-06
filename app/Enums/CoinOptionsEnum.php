<?php

namespace App\Enums;

enum CoinOptionsEnum: string
{
    case USD = 'Dólar';
    case EUR = 'Euro';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
