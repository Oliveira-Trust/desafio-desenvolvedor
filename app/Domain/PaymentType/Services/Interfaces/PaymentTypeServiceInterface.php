<?php

declare(strict_types=1);

namespace App\Domain\PaymentType\Services\Interfaces;

/**
 *
 */
interface PaymentTypeServiceInterface
{
    public function getAllPaymentTypes():object;

    public function getPaymentType(int $paymentTypeId):array;

    
}
