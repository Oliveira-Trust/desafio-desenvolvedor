<?php

namespace Database\Seeders;

use Domain\Fees\Models\Fees;
use Domain\PaymentMethod\Repositories\PaymentMethodRepository;
use Illuminate\Database\Seeder;

class FeesSeeder extends Seeder
{
    public function run()
    {
        $paymentMethodRepository = new PaymentMethodRepository();

        Fees::create([
            'payment_method_id' => $paymentMethodRepository->findByName('boleto')->id,
            'percentage' => 1.45,
        ]);

        Fees::create([
            'payment_method_id' => $paymentMethodRepository->findByName('cartao')->id,
            'percentage' => 7.63,
        ]);
    }
}
