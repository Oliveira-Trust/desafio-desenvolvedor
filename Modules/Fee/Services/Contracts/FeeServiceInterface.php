<?php

namespace Modules\Fee\Services\Contracts;

interface FeeServiceInterface
{
    /**
     * @param float $value
     * @param string $paymentMethod
     * @return array
     */
    public function applyFees(float $value, string $paymentMethod): array;

    /**
     * @param float $value
     * @return float
     */
    public function getValueFee(float $value): float;

    /**
     * @param float $value
     * @param string $paymentMethod
     * @return float
     */
    public function getPaymentMethodFee(float $value, string $paymentMethod): float;

    /**
     * @param array $fees
     * @param float $value
     * @return float
     */
    public function calcValueAfterFees(array $fees, float $value): float;
}
