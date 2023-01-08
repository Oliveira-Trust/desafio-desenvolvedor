<?php

namespace Database\Factories;

use App\Models\Fee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FeeFactory extends Factory {
    protected $model = Fee::class;

    public function definition(): array {
        return [
            'starting_value' => $this->faker->randomFloat(2,1000, 10000),
            'fee_rate'       => $this->faker->randomFloat(2,0,5),
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),
        ];
    }
}
