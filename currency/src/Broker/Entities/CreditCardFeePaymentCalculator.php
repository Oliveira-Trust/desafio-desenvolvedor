<?php

declare(strict_types=1);

namespace Module\Broker\Entities;

class CreditCardFeePaymentCalculator implements FeePaymentInterface
{
    const FEE_PERCENT = 7.63;

    public function calculate(Invoice $invoice): int
    {
        return (int) ($invoice->amountInCents() * self::FEE_PERCENT / 100);
    }
}
