<?php

namespace App\Domain\PaymentType\Repositories\Interfaces;
use App\Domain\PaymentType\Models\PaymentType;

interface PaymentTypeRepositoryInterface {

    public function getAll();

    public function getPaymentType(int $paymentTypeId);

}
