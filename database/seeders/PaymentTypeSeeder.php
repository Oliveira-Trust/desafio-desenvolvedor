<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\PaymentType\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::create([
            'name'   => 'Boleto',
            'class_name' => 'Boleto'
        ]);

        PaymentType::create([
            'name'   => 'Cartão de Crédito',
            'class_name' => 'CreditCard'
        ]);

    }
}
