<?php

namespace App\Enums;

enum Currencies: string
{
    case USD = 'USD';
    case EUR = 'EUR';
    case ARS = 'ARS';
    case JPY = 'JPY';

    public static function toArray(): array
    {
        foreach (self::cases() as $value) {
            $array[$value->name] = $value->value;
        }

        return $array;
    }

    public static function symbol(string $currency): string
    {
        return match ($currency) {
            'USD' => 'USD $',
            'EUR' => 'EUR €',
            'ARS' => 'ARS $',
            'JPY' => 'JPY ¥',
            default => '',
        };
    }
}
