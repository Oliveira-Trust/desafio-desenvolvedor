<?php

declare(strict_types=1);

namespace App\Domain\Fee\Services\Interfaces;

/**
 *
 */
interface FeeServiceInterface
{
    public function getFee(int $id):?object;

    public function getAllFees():object;

    public function getDefaultFee(float $amount, float $amountAfterSubtractingDefaultFee):float;

    public function getFeeByPaymentMethod(float $amount, float $amountAfterSubtractingDefaultFee, string $className):?float;

    public function updateFee($request, $fee):bool;

    public function subtractFeesFromAmount(array $fees, float $amount):float;
}
