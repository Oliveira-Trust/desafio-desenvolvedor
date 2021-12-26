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
        $response = [];
        if(count($payments) > 0 ) {
            foreach($payments as $payment){
                $response[] = $payment->toArray();
            }   
            return $response;
        }
        return $response;
    }
}