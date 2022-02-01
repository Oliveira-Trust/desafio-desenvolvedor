<?php

namespace Domain\Fees\Repositories\Interfaces;

use Domain\Fees\Models\Fees;

interface FeesRepositoryInterface
{
    public function findById(int $id): Fees;

    public function findByPaymentMethodId(int $paymentMethodId): Fees;
}
