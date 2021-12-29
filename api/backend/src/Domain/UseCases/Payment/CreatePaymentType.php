<?php

declare(strict_types=1);

namespace App\Domain\UseCases\Payment;

use App\Domain\Contracts\Repository\PaymentRepositoryInterface;
use App\Domain\Entities\Payment;

class CreatePaymentType
{
    private $dataPayment;
    private $repository;
    public function __construct(array $data, PaymentRepositoryInterface $repository)
    {
        $this->dataPayment = $data;
        $this->repository = $repository;
    }
    public function execute()
    {
        $data = $this->dataPayment;
        if(empty($data)){
            throw new \Exception('It is not possible to create a payment without data');
        }
        $payment = new Payment();
        foreach($data as $key => $value) {
            if(!$value) {
                throw new \Exception("Field {$key} is Empty.");
            }
            $payment->{'set'.ucfirst($key)}($value);
        }
        $paymentExists = $this->repository->getByType($payment->getType());
        if($paymentExists){
            throw new \Exception('Payment already registered.');
        }
        
        return $this->repository->save($payment);
    }
}