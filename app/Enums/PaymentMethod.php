<?php

namespace App\Enums;

enum PaymentMethod: int
{
    case BOLETO_BANCARIO = 1;
    case CARTAO_CREDITO = 2;

    public function getDescription(): string
    {
        return match ($this) {
            self::BOLETO_BANCARIO => 'Boleto Bancário',
            self::CARTAO_CREDITO => 'Cartão de Crédito',
        };
    }

    public function getFee(): float
    {
        return match ($this) {
            self::BOLETO_BANCARIO => 0.0145,
            self::CARTAO_CREDITO => 0.0763,
        };
    }
    public function getFeePercentage(): string
    {
        $percentage = match ($this) {
            self::BOLETO_BANCARIO => 0.0145 * 100,
            self::CARTAO_CREDITO => 0.0763 * 100,
        };

        return str_replace('.', ',', number_format($percentage, 2)) . '%';
    }
}
