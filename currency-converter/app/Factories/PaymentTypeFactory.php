<?php

namespace App\Factories;

use App\Models\PaymentType\PaymentType;
use App\Models\PaymentType\PaymentTypeContract;

class PaymentTypeFactory
{
    public function bySlug(string $slug): PaymentTypeContract
    {
        $filteredPayments = PaymentType::findAll()->filter(function($payment) use ($slug) {
            return $payment->getSlug() === $slug;
        });

        if ($filteredPayments->isEmpty()) {
            /** @todo criar exception especifica */
            throw new \Exception('Não encontrou nenhum tipo de pagamento');
        }

        return $filteredPayments->first();
    }
}