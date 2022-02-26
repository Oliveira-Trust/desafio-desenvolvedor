<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{

    /**
     * List payments methods
     * @var $paymentMethods
     */
    private $paymentMethods = [
        'Boleto',
        'Crédito'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->paymentMethods as $key => $paymentMethod) {
            PaymentMethod::create([
                'name' => $paymentMethod
            ]);
        }
    }
}
