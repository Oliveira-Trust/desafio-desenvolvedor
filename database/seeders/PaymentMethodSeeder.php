<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Boleto',
                'label' => 'BILLET',
                'description' => 'Boleto',
                'tax' => 1.45,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cartão de Credito',
                'label' => 'CREDIT_CARD',
                'description' => 'Cartão de Credito',
                'tax' => 7.63,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        PaymentMethod::insert($methods);
    }
}
