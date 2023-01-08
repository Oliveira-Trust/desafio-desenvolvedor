<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder {
    public function run() {

        $this->command->getOutput()->info("Seeding payment methods");

        PaymentMethod::insert([
            [
                'name'       => 'Boleto',
                'fee_rate'   => 1.45,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Cartão de crédito',
                'fee_rate'   => 7.63,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
