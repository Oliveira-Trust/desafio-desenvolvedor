<?php

namespace Database\Seeders;

use Domain\PaymentMethod\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run()
    {
        PaymentMethod::create([
            'name'      => 'boleto',
            'display_name'     => 'Boleto',
        ]);

        PaymentMethod::create([
            'name'      => 'cartao',
            'display_name'     => 'Cartão',
        ]);
    }
}
