<?php

use Akaunting\Money\Currency;
use Akaunting\Money\Money;

/**
 * Format an amount to the given currency
 *
 * @return response()
 */

use Modules\Exchange\Enums\PaymentMethod;

if (!function_exists('formatCurrency')) {
    function formatCurrency($amount, $currency = 'BRL')
    {
        $money = new Money($amount, new Currency($currency), true);
        return $money->format();
    }
}

if (!function_exists('formatPaymentMethod')) {
    function formatPaymentMethod($paymentMethod)
    {
        if ($paymentMethod === PaymentMethod::BANK_SLIPS()) {
            return 'Boleto';
        }

        return 'Cartão de Crédito';
    }
}
