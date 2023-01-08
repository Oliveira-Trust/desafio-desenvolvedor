<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PaymentMethodFactory extends Factory {
    protected $model = PaymentMethod::class;

    public function definition(): array {
        return [
            'name'       => $this->faker->name(),
            'fee_rate'   => $this->faker->randomFloat(2, 0, 5),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
