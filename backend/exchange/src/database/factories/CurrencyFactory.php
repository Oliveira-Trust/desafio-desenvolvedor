<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CurrencyFactory extends Factory {
    protected $model = Currency::class;

    public function definition(): array {
        return [
            'name'             => $this->faker->name(),
            'code'             => $this->faker->numberBetween(100, 99999),
            'available_to_buy' => $this->faker->boolean(),
            'created_at'       => Carbon::now(),
            'updated_at'       => Carbon::now(),
        ];
    }
}
