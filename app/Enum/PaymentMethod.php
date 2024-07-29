<?php
namespace App\Enum;

enum PaymentMethod: string
{
    case boleto_fee = 'Boleto';
    case credit_card_fee = 'Cartão de Crédito';
}
