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
        \App\Models\PaymentMethod::create([
            'id' => 1,
            'title' => 'Boleto',
            'fee' => 1.45
        ]);

        \App\Models\PaymentMethod::create([
            'id' => 2,
            'title' => 'Cartão de Crédito',
            'fee' => 7.63
        ]);
    }
}
