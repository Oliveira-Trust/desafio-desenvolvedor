<?php

namespace App\Domain\Fee\Repositories\Interfaces;


interface FeeRepositoryInterface {

    public function getFee(int $id):?object;

    public function getAllFees():object;

    public function getDefaultServiceFee():float;

    public function getExceptionServiceFee($amount):?float;

    public function updateFee($fee):bool;

    public function getFeeByPaymentMethod(string $paymentMethod):float;

}
