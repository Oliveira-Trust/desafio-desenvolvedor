<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\PaymentMethod::factory()->createMany([[
            'slug' => 'credit_card',
            'name' => 'Cartão de crédito',
            'fee'  => 7.63
        ], [
            'slug' => 'billet',
            'name' => 'Boleto',
            'fee'  => 1.45
        ]]);
    }
}
