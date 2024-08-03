<?php

namespace Database\Factories;

use App\Models\Conversion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConversionFactory extends Factory
{
    protected $model = Conversion::class;

    public function definition()
    {
        return [
            'from' => $this->faker->currencyCode,
            'to' => $this->faker->currencyCode,
            'amount' => $this->faker->randomFloat(2, 1000, 100000),
            'payment_method' => $this->faker->randomElement(['boleto', 'credit_card']),
            'currency_value' => $this->faker->randomFloat(2, 0.1, 10),
            'purchase_amount' => $this->faker->randomFloat(2, 100, 10000),
            'conversion_rate' => $this->faker->randomFloat(2, 0.01, 0.1),
            'payment_rate' => $this->faker->randomFloat(2, 0.01, 0.1),
            'purchase_price_excluding_taxes' => $this->faker->randomFloat(2, 1000, 100000),
        ];
    }
}
