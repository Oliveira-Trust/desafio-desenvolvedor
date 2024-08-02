<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'Boleto Bancário'],
            ['name' => 'Cartão de Crédito'],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::firstOrCreate($method);
        }
    }
}
