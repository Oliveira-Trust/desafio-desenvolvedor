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
        PaymentMethod::factory()->createMany([
            [
                'id' => 'credit_card',
                'name' => 'Cartão de crédito',
                'fee'  => 7.63
            ], [
                'id' => 'billet',
                'name' => 'Boleto',
                'fee'  => 1.45
            ]
        ]);
    }
}
