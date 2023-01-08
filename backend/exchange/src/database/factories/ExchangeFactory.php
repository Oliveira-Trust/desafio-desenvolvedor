<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\Exchange;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ExchangeFactory extends Factory {
    protected $model = Exchange::class;

    public function definition(): array {
        return [
            'user_id'                   => $this->faker->randomNumber(),
            'origin_value'              => $this->faker->randomFloat(2,1000,5000),
            'origin_value_without_fees' => $this->faker->randomFloat(2,1000,5000),
            'purchased_value'           => $this->faker->randomFloat(2,1000,5000),
            'destination_exchange_rate' => $this->faker->randomFloat(2,1000,5000),
            'payment_method_fee_value'  => $this->faker->randomFloat(2,1000,5000),
            'exchange_fee_value'        => $this->faker->randomFloat(2,1000,5000),
            'origin_currency_id'        => Currency::factory(),
            'destination_currency_id'   => Currency::factory(),
            'payment_method_id'         => PaymentMethod::factory(),
            'created_at'                => Carbon::now(),
            'updated_at'                => Carbon::now(),
        ];
    }
}
