<?php

namespace Database\Factories;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Historic>
 */
class HistoricFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => UserFactory::factory(),
            // 'payment' => 'Boleto',
            // 'payment_fee' => 1.45,
            // 'origin_currency' => 'BRL',
            // 'destination_currency' => 'USD',
            // 'currency_value' => 5000.00,
            // 'destination_currency_value' => 5.30,
            // 'purchased_value' => 920.18,
            // 'payment_fee' => 72.50,
            // 'conversion_fee' => 50.00,
            // 'conversion_value' => 4877.50
        ];
    }
}
