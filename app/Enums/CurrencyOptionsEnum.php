<?php

namespace App\Enums;

enum CurrencyOptionsEnum: string
{
    case USD = 'Dólar';
    case EUR = 'Euro';

    public static function values(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function fromName(string $name): string
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status->value;
            }
        }
    }
}
