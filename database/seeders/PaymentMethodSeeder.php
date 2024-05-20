<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            [
                'type' => "payment_slip",
                'label' => "Boleto",
                "value" => 0.0145,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => "credit_card",
                'label' => "Cartão de Crédito",
                "value" => 0.0763,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('payment_methods')->insert($paymentMethods);
    }
}
