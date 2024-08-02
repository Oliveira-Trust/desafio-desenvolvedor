<?php

namespace App\Enums;

enum Currency: string
{
    case USD = 'Dólar dos Estados Unidos';
    case EUR = 'Euro';
    case GBP = 'Libra Esterlina';
    case JPY = 'Yen Japonês';
    case AUD = 'Dólar Australiano';
    case CAD = 'Dólar Canadense';
    case CHF = 'Franco Suíço';
    case CNY = 'Yuan Chinês';
    case MXN = 'Peso Mexicano';
    case INR = 'Rúpia Indiana';
    case ARS = 'Peso Argentino';
    case ZAR = 'Rand Sul-Africano';



    public static function getValue(string $key): ?string
    {
        foreach (self::cases() as $currency) {
            if ($currency->name === $key) {
                return $currency->value;
            }
        }
        return null;
    }
}