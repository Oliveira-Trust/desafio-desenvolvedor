<?php

namespace App\Domain\Fee\Services;

use App\Domain\Fee\Services\Interfaces\FeeServiceInterface;
use App\Domain\Fee\Repositories\Interfaces\FeeRepositoryInterface;
use App\Domain\PaymentType\Repositories\Interfaces\PaymentTypeRepositoryInterface;
use App\Domain\Fee\Factories\FeeFactory;

class FeeService implements FeeServiceInterface {

    public function __construct(FeeRepositoryInterface $feeRepository)
    {
        $this->feeRepository = $feeRepository;
    }

    public function getFee(int $id):?object
    {
        $fee = $this->feeRepository->getFee($id);

        return $fee;
    }

    public function getAllFees():object
    {
        $fees = $this->feeRepository->getAllFees();

        return $fees;
    }


    public function getFeeByPaymentMethod(float $amount, float $amountAfterSubtractingDefaultFee, string $paymentMethodClassName):?float
    {
        $newClass = FeeFactory::createNewClass($paymentMethodClassName);
        $newAmount = $newClass->calculateFee($amount, $amountAfterSubtractingDefaultFee);

        return $newAmount;
    }

    public function getDefaultFee(float $amount, float $amountAfterSubtractingDefaultFee):float
    {
        $defaultFeeClass = FeeFactory::instantiateDefaultFeeClass($this->feeRepository);
        $newAmount = $defaultFeeClass->calculateFee($amount, $amountAfterSubtractingDefaultFee);

        return $newAmount;
    }

    public function updateFee($request, $fee):bool
    {
        if($request->dependsOn) {
            $fee->depends_on = $request->dependsOn;
        }

        if($request->fee) {
            $fee->fee = $request->fee;
        }

        return $this->feeRepository->updateFee($fee);
    }

    private function getKeysFromCollection($collection):object
    {
        $filteredResult = $collection->mapWithKeys(function ($item, $key) {
          return [$item['id'] => $item['type']];
        });

        return $filteredResult;
    }

    public function subtractFeesFromAmount(array $fees, float $paymentAmount):float
    {
        $feeAmount = 0;

        foreach ($fees as $fee) {
            $feeAmount += $fee;
        }

        $amountAfterFees = $paymentAmount - $feeAmount;

        return $amountAfterFees;
    }


}
