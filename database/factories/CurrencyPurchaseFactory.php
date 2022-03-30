<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\PaymentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyPurchaseFactory extends Factory
{
    public function definition()
    {
        return [
            'origin_currency' => 'BRL',
            'origin_currency_value' => $this->faker->randomFloat(2, 1000, 100000),
            'destination_currency_id' => Currency::query()->inRandomOrder()->value('id'),
            'payment_type_id' => PaymentType::query()->inRandomOrder()->value('id'),
        ];
    }

}
