<?php

namespace App\Services\PaymentFee;

use App\Services\PaymentFee\PaymentFeeServiceContract;
use App\Repositories\PaymentFee\PaymentFeeRepositoryContract;

class PaymentFeeService implements PaymentFeeServiceContract
{
    protected $paymentFeeRepository;

    public function __construct(PaymentFeeRepositoryContract $paymentFeeRepository)
    {
        $this->paymentFeeRepository = $paymentFeeRepository;
    }

    public function getById(int $id)
    {
        return $this->paymentFeeRepository->getById($id);
    }

    public function all()
    {
        return $this->paymentFeeRepository->all();
    }

    public function getByAttribute(string $field, string $attribute)
    {
        return $this->paymentFeeRepository->getByAttribute($field, $attribute);
    }

    public function store(array $data)
    {
        return $this->paymentFeeRepository->store($data);
    }

    public function updateById(array $data, int $id)
    {
        return $this->paymentFeeRepository->updateById($data, $id)
            ->update($data);
    }

    public function delete(int $id)
    {
        return $this->paymentFeeRepository->delete($id)
            ->delete();
    }

    public function getByType(int $type)
    {
        return $this->paymentFeeRepository->getByType($type);
    }

    public function calculatePaymentFee($value, $type)
    {
        $paymentFee = $this->getByType($type);
        
        return $value / 100 * $paymentFee->fee;
    }
}
