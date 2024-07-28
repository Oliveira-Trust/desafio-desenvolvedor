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
        $methods = [
          [
              'method_name' => 'boleto',
              'method_tax' => 1.45
          ],
            [
                'method_name' => 'cartão de crédito',
                'method_tax' => 7.63
            ]

        ];

        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}
