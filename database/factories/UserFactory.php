<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserFactory extends Factory {

	protected $model = User::class;

	public function definition(): array {
		return [
			'name'              => $this->faker->name(),
			'username'          => $this->faker->userName(),
			'email'             => $this->faker->unique()->safeEmail(),
			'email_verified_at' => Carbon::now(),
			'password'          => bcrypt($this->faker->password()),
			'remember_token'    => null,
			'deleted_at'        => null,
			'created_at'        => Carbon::now(),
			'updated_at'        => null,
		];
	}
}
