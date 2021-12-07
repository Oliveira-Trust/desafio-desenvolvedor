<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_method')->insert([
            'name' => 'Boleto',
            'value' => 1.45,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('payment_method')->insert([
            'name' => 'Cartão de Crédito',
            'value' => 7.63,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
