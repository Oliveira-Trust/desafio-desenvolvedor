<?php

namespace Domain\Fees\Repositories;

use Domain\Fees\Models\Fees;
use Domain\Fees\Repositories\Interfaces\FeesRepositoryInterface;

class FeesRepository implements FeesRepositoryInterface
{
    public function findByPaymentMethodId(int $paymentMethodId): Fees
    {
        return Fees::where('payment_method_id', $paymentMethodId)->first();
    }

    public function findById(int $id): Fees
    {
        return Fees::find($id);
    }
}
