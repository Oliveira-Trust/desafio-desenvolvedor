<?php

declare(strict_types=1);

namespace App\Domain\Fee\Strategies\Interfaces;

/**
 *
 */
interface PaymentMethodFeeInterface
{
    public function calculateFee(float $value, float $amountAfterSubtractingDefaultFee):?float;
}
