<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->randomNumber(6, true),
            'name' => $this->faker->unique()->slug(),
            'description' => $this->faker->paragraph,
            'price' =>  $this->faker->randomFloat(2, 1, 100),
            'stock' => $this->faker->randomNumber(3, true),
        ];
    }
}
