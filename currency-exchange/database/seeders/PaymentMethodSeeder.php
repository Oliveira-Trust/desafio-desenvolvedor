<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::insert([
            [
                'id' => 1,
                'name' => 'Boleto',
                'fee' => '1.45',
            ],
            [
                'id' => 2,
                'name' => 'Cartão de crédito',
                'fee' => '7.63',
            ],
        ]);
    }
}
