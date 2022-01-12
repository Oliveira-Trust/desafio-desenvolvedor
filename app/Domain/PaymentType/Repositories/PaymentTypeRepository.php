<?php

namespace App\Domain\PaymentType\Repositories;

use App\Domain\PaymentType\Repositories\Interfaces\PaymentTypeRepositoryInterface;
use App\Domain\PaymentType\Models\PaymentType;

class PaymentTypeRepository implements PaymentTypeRepositoryInterface {

    public function __construct(PaymentType $paymentType) {
        $this->paymentType = $paymentType;
    }


    public function getAll()
    {
        return $this->paymentType->all();
    }

    public function getPaymentType(int $paymentTypeId)
    {
        return $this->paymentType->find($paymentTypeId);
    }
}
