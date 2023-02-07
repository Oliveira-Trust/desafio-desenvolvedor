<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PaymentMethod::create([
            'name' => 'Boleto',
            'tax' => 1.45,
        ]);
        PaymentMethod::create([
            'name' => 'Cartão de Crédito',
            'tax' => 7.63,
        ]);
    }
}
