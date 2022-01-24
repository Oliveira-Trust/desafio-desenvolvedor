<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Boleto',
            'slug' => 'billet',
            'fees' => 1.45,
        ];
    }
}
