<?php

namespace App\Domain\Fee\Strategies;

use App\Domain\Fee\Strategies\Interfaces\PaymentMethodFeeInterface;
use App\Domain\Fee\Repositories\Interfaces\FeeRepositoryInterface;

class DefaultFee implements PaymentMethodFeeInterface {

    public function __construct(FeeRepositoryInterface $fee)
    {
        $this->feeRepository = $fee;
    }

    public function calculateFee(float $amount, float $amountAfterSubtractingDefaultFee):float
    {
        $fee = $this->feeRepository->getExceptionServiceFee($amount);

        if(!$fee) {
            $fee = $this->feeRepository->getDefaultServiceFee();
        }

        $valueAfterFee =  $amount * ((100 - $fee) / 100);

        $defaultServiceFee = $amount - $valueAfterFee;

        return $defaultServiceFee;
    }

}
