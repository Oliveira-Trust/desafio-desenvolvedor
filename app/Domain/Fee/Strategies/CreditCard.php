<?php

namespace App\Domain\Fee\Strategies;

use App\Domain\Fee\Strategies\Interfaces\PaymentMethodFeeInterface;


class CreditCard implements PaymentMethodFeeInterface {

    public function calculateFee(float $value, float $amountAfterSubtractingDefaultFee):?float
    {
        $fee = 7.63;

        $valueAfterFee =  $value * ((100 - $fee) / 100);

        $creditCardFee = $value - $valueAfterFee;

        $feeAvailability = $amountAfterSubtractingDefaultFee - $creditCardFee;

        if($feeAvailability < 0){
            return null;
        }

        return $creditCardFee;
    }

}
