<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\PaymentMethod;
use App\Repositories\Contracts\PaymentMethodRepositoryInterface;

class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{
    public function model() : string
    {
        return PaymentMethod::class;
    }
}
