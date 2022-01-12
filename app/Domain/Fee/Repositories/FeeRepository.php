<?php

namespace App\Domain\Fee\Repositories;

use App\Domain\Fee\Repositories\Interfaces\FeeRepositoryInterface;
use App\Domain\Fee\Models\Fee;

class FeeRepository implements FeeRepositoryInterface {

    public function __construct(Fee $fee)
    {
        $this->feeModel = $fee;
    }

    public function getFee(int $id):?object
    {
        return $this->feeModel->find($id);
    }

    public function getAllFees():object
    {
        return $this->feeModel->all();
    }

    public function getDefaultServiceFee():float
    {
        return $this->feeModel->where('type', 'defaultServiceFee')->first()->fee;
    }

    public function getExceptionServiceFee($amount):?float
    {
        $fee = $this->feeModel->where('type', 'discount')
                         ->where('depends_on', '<=', $amount)
                         ->orderBy('depends_on', 'desc')
                         ->first();

        if($fee) {
           return $fee->fee;
        }

        return null;
    }

    public function updateFee($fee):bool
    {
        return $fee->save();
    }

    public function getFeeByPaymentMethod(string $paymentMethod):float
    {
        return $this->feeModel->where('type', 'paymentMethod')
                              ->where('payment_method', $paymentMethod)
                              ->first()
                              ->fee;
    }
}
