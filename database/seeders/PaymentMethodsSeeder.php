<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class PaymentMethodsSeeder extends Seeder
{
    public function run()
    {
        $this->getPaymentMethods()->each(function ($paymentMethod) {
           PaymentMethod::create($paymentMethod);
        });
    }

    public function getPaymentMethods() : Collection
    {
        return collect([
            [
                'name' => 'Boleto',
                'slug' => 'billet',
                'fees' => 1.45,
            ],
            [
                'name' => 'Cartão de crédito',
                'slug' => 'credit-card',
                'fees' => 7.63,
            ]
        ]);
    }
}
