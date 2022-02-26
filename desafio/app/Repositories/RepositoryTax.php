<?php

namespace App\Repositories;

use App\Models\Tax;

class RepositoryTax
{
    /**
     * @param string $paymentMethod
     * @return Tax|null
     */
    public function find(string $paymentMethod)
    {
        return Tax::where('payment_method_id', $paymentMethod)
            ->first();
    }
}