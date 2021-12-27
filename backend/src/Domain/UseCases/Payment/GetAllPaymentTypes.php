<?php

declare(strict_types=1);

namespace App\Domain\UseCases\Payment;

use App\Domain\Contracts\Repository\PaymentRepositoryInterface;

class GetAllPaymentTypes
{
    private $repository;
    public function __construct(PaymentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function execute(): array
    {
        $payments = $this->repository->getAll();
        if(empty($payments)){
            throw new \Exception("No registered payments.");
        }
        return $payments;
    }
}