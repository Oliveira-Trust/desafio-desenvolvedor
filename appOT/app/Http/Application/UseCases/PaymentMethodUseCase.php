<?php

namespace App\Http\Application\UseCases;

use App\Http\Requests\PaymentMethodRequest;
use App\Domain\Repositories\PaymentMethodRepositoryInterface;

class PaymentMethodUseCase
{
    /**
     * @var PaymentMethodRepositoryInterface
     */    private PaymentMethodRepositoryInterface $paymentMethodRepositoryInterface;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepositoryInterface)
    {

        $this->paymentMethodRepositoryInterface = $paymentMethodRepositoryInterface;
    }
    public function index()
    {
        return $this->paymentMethodRepositoryInterface->index();
    }

    public function store(PaymentMethodRequest $request)
    {
        return $this->paymentMethodRepositoryInterface->store($request);
    }
   
    public function show(int $id): array
    {
        return $this->paymentMethodRepositoryInterface->show($id);
    }

    public function getTax(int $id): float
    {
        return $this->paymentMethodRepositoryInterface->getTax($id);
    }
    
}
