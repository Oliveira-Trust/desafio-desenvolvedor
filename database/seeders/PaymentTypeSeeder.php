<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Oliveiratrust\Models\PaymentType\PaymentType;

class PaymentTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::create(['description' => 'Boleto']);
        PaymentType::create(['description' => 'Cartão de crédito']);
    }
}
