<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
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
        PaymentMethod::create([
           'method' => 'Boleto Bancário',
           'fee'    => 1.45
        ]);

        PaymentMethod::create([
            'method' => 'Cartão de Crédito',
            'fee'    => 7.63
        ]);
    }
}
