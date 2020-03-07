<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;
use App\User;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'name' => $faker->name,
        'phone'=> $faker->phoneNumber,
        'address' => $faker->address,
    ];
});
