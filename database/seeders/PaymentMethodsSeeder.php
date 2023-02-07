<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\PaymentMethod;

class PaymentMethodsSeeder extends Seeder
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
            'code' => 'USD',
            'name' => 'Dólar',
        ]);
        PaymentMethod::create([
            'code' => 'EUR',
            'name' => 'Euro',
        ]);
    }
}
