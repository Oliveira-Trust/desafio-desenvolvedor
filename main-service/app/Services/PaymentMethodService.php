<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\StatusType;
use App\Models\PaymentMethod;
use App\Repositories\Contracts\PaymentMethodRepositoryInterface;

class PaymentMethodService
{
    protected $payMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $payMethodRepository)
    {
        $this->payMethodRepository = $payMethodRepository;
    }

    public function getAllPaymentMethods() : array
    {
        return $this->payMethodRepository->getAll()->toArray();
    }

    public function getAllActivePaymentMethods() : array
    {
        return $this->payMethodRepository->findWhere('status', StatusType::ACTIVATED)
                                          ->toArray();
    }

    public function getPaymentMethodObj(int $id) : PaymentMethod
    {
        $result = $this->payMethodRepository->findById($id);

        return PaymentMethod::createFromEloquent($result);
    }

    public function getPaymentMethodById(int $id) : PaymentMethod
    {
        return $this->payMethodRepository->findById($id);
    }

    public function storePaymentMethod(array $request) : PaymentMethod
    {
        return $this->payMethodRepository->store($request);
    }

    public function updatePaymentMethod(int $id, array $request) : bool
    {
        return $this->payMethodRepository->update($id, $request);
    }
}
