<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'name' => $this->faker->name, 
                'email' => $this->faker->word . '_' . $this->faker->unique()->safeEmail(), 
                'password' => bcrypt('password'), 
                'email_verified_at' => Carbon::now(), 
                'remember_token' => $this->faker->word,  
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
        ];
    }
}
