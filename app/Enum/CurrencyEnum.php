<?php

namespace App\Enum;

enum CurrencyEnum: string
{
    case BRL = 'BRL';
    case USD = 'USD';
    case EUR = 'EUR';
    case ARS = 'ARS';

    public function symbol(): string
    {
        return match ($this) {
            self::BRL => 'R$',
            self::USD => '$',
            self::EUR => '€',
            self::ARS => 'ARS$', // Differentiate if needed
        };
    }

    public static function convertable(): array
    {
        return array_column(array_filter(self::cases(), fn ($currency) => $currency !== self::BRL), 'value');
    }
}
