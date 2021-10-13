<?php

namespace Database\Factories;

use App\Models\Fee;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type'          => $this->faker->unique()->randomLetter,
            'range'         => $this->faker->randomNumber(),
            'less_than'     => $this->faker->randomFloat(1, 4),
            'more_than'     => $this->faker->randomFloat(1, 4),
            'description'   => $this->faker->sentence,
            'status'        => 1
        ];
    }
}
