<?php

declare(strict_types=1);

namespace Module\Broker\Entities;

class BankSlipFeePaymentCalculator implements FeePaymentInterface
{
    const FEE_PERCENT = 1.45;

    public function calculate(Invoice $invoice): int
    {
        return (int) ($invoice->amountInCents() * self::FEE_PERCENT / 100);
    }
}
