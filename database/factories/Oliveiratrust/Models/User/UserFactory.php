<?php

namespace Database\Factories\Oliveiratrust\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Oliveiratrust\Models\User\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Oliveiratrust\Models\User\User>
 */
class UserFactory extends Factory {

    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'     => $this->faker->name,
            'email'    => $email = $this->faker->email,
            'password' => $email,
            'is_admin' => false
        ];
    }
}
