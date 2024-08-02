<?php

namespace Module\Broker\Factories;

use Module\Broker\Entities\BankSlipFeePaymentCalculator;
use Module\Broker\Entities\CreditCardFeePaymentCalculator;
use Module\Broker\Entities\FeePaymentInterface;
use Module\Broker\Enums\PaymentMethod;

class CalculatorFeePaymentFactory
{
    public static function make(string $paymentMethod): FeePaymentInterface
    {
        $method = PaymentMethod::tryFrom($paymentMethod);

        return match ($method) {
            PaymentMethod::CREDIT_CARD => new CreditCardFeePaymentCalculator,
            PaymentMethod::BANK_SLIP => new BankSlipFeePaymentCalculator,
            default => throw new \InvalidArgumentException('Invalid payment method'),
        };
    }
}
