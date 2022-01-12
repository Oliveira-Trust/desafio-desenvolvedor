<?php

namespace App\Domain\PaymentType\Services;

use App\Domain\PaymentType\Services\Interfaces\PaymentTypeServiceInterface;
use App\Domain\PaymentType\Repositories\Interfaces\PaymentTypeRepositoryInterface;

class PaymentTypeService implements PaymentTypeServiceInterface {

    public function __construct(PaymentTypeRepositoryInterface $paymentType)
    {
        $this->paymentTypeRepository = $paymentType;
    }

    public function getAllPaymentTypes():object
    {
        $paymentTypes = $this->paymentTypeRepository->getAll();

        $paymentTypes = $this->getKeysFromCollection($paymentTypes);

        return $paymentTypes;
    }

    public function getPaymentType(int $paymentTypeId):array
    {
        return $this->paymentTypeRepository->getPaymentType($paymentTypeId)->toArray();
    }

    private function getKeysFromCollection($collection):object
    {
        $filteredResult = $collection->mapWithKeys(function ($item, $key) {
          return [$item['id'] => $item['name']];
        });

        return $filteredResult;
    }

}
