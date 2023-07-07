<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_methods')->insert([
            'name' => 'Boleto',
            'tax' => 0.0145,
        ]);
        DB::table('payment_methods')->insert([
            'name' => 'Cartão de Crédito',
            'tax' => ' 0.0763',
        ]);
    }
}
