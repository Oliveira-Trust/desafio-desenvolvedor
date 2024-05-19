<?php

namespace App\Services;

class ConversionService
{
    public function __construct(
        private TaxService $taxService
    ) {
    }

    public function calculateTargetAmount(float $bid, float $amount, int $paymentMethodId): array
    {
        $paymentFee = $this->taxService->getPaymentFee($amount, $paymentMethodId);
        $amountFee = $this->taxService->getConversionFee($amount);

        return [
            'targetAmount' => ($amount - $paymentFee - $amountFee) / $bid,
            'paymentFee' => $paymentFee,
            'amountFee' => $amountFee,
        ];
    }
}
