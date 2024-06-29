<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //alterar para usar repository ou model
        DB::table('payment_methods')->insert([
            [
                'name_reference' => 'boleto',
                'name' => 'Boleto',
                'tax' => 1.45,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name_reference' => 'cartao_de_credito',
                'name' => 'Cartão de crédito',
                'tax' => 7.63,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
