<?php

namespace App\Enums;

enum PaymentType: string
{
    case Boleto = 'BOLETO';
    case CreditCard = 'CREDIT_CARD';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::Boleto => 'Boleto Bancário',
            self::CreditCard => 'Cartão de Crédito',
            default => 'Desconhecido'
        };
    }

    public static function getDescription(string $value): string
    {
        return match ($value) {
            'BOLETO' => 'Boleto Bancário',
            'CREDIT_CARD' => 'Cartão de Crédito',
            default => 'Desconhecido'
        };
    }

    public static function getValues(): array
    {
        return ['BOLETO', 'CREDIT_CARD'];
    }
}
