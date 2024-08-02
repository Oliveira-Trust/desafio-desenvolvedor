<?php

namespace Module\Broker\Entities;

class ConversionValuesForRatesGreaterThanThreeThousand extends ConversionFeeCalculator
{
    const THRESHOLD = 300000;

    const FEE = 1.00;

    public function apply(Invoice $invoice): int
    {
        if ($invoice->amountInCents() > self::THRESHOLD) {
            return (int) ($invoice->amountInCents() * self::FEE / 100);
        }

        return $this->next?->apply($invoice);
    }
}
