<?php

namespace App\Services;

use App\Models\Tax;

class TaxService
{
    public function getPaymentFee(float $amount, int $paymentMethodId): float
    {
        $tax = Tax::type('payment_fee')->enabled()->paymentMethod($paymentMethodId)->firstOrFail();

        if ($tax->rate === 0) {
            return 0;
        }

        return $amount * ($tax->rate / 100);
    }

    public function getConversionFee(float $amount)
    {
        $tax = Tax::type('amount_fee')->enabled()->firstOrFail();

        $taxRate = $amount >= $tax->amount
            ? $tax->max_amount_rate
            : $tax->min_amount_rate;

        return $amount * ($taxRate / 100);
    }
}
