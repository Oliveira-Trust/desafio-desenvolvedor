<?php

namespace App\Domain\Fee\Strategies;

use App\Domain\Fee\Strategies\Interfaces\PaymentMethodFeeInterface;
use App\Domain\Fee\Repositories\Interfaces\FeeRepositoryInterface;

class Boleto implements PaymentMethodFeeInterface {

    public function __construct(FeeRepositoryInterface $fee)
    {
        $this->feeRepository = $fee;
    }

    public function calculateFee(float $value, float $amountAfterSubtractingDefaultFee):?float
    {
        $fee = $this->feeRepository->getFeeByPaymentMethod('boleto');

        $valueAfterFee =  $value * ((100 - $fee) / 100);

        $paymentMethodFee = $value - $valueAfterFee;

        $feeAvailability = $amountAfterSubtractingDefaultFee - $paymentMethodFee;

        if($feeAvailability < 0){
            return null;
        }

        return $paymentMethodFee;
    }

}
