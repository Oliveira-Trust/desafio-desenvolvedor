<?php

namespace Modules\Fee\Services;

use Modules\Fee\Repositories\Contracts\FeeRepositoryInterface;
use Modules\Fee\Services\Contracts\FeeServiceInterface;

class FeeService implements FeeServiceInterface
{
    private $feeRepository;

    public function __construct(FeeRepositoryInterface $feeRepository)
    {
        $this->feeRepository = $feeRepository;
    }

    public function applyFees(float $value, string $paymentMethod): array
    {
        $valueFee = $this->getValueFee($value);
        $paymentMethodFee = $this->getPaymentMethodFee($value, $paymentMethod);

        $valueAfterFees = $this->calcValueAfterFees([$valueFee, $paymentMethodFee], $value);

        return [
            'value_fee' => $valueFee,
            'payment_method_fee' => $paymentMethodFee,
            'final_value' => $valueAfterFees
        ];
    }

    public function getValueFee(float $value): float
    {
        $feeType = $value < 3000 ? 'less_than_3000' : 'more_than_3000';
        $fee = $this->feeRepository->getFeeValueByColumnName($feeType);
        return $value * $fee;
    }

    public function getPaymentMethodFee(float $value, string $paymentMethod): float
    {
        $fee = $this->feeRepository->getFeeValueByColumnName($paymentMethod);
        return $value * $fee;
    }

    public function calcValueAfterFees(array $fees, float $value): float
    {
        return $value - array_sum($fees);
    }
}
