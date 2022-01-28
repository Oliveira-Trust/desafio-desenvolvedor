<?php

namespace Database\Factories;

use App\Models\PaymentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentTypeFactory extends Factory
{
    protected $model = PaymentType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'boleto',
            'display_name' => 'Boleto'
        ];
    }
}
