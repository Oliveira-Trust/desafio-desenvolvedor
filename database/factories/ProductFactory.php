<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use App\User;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'name' => $faker->numerify('Product ##'),
        'ean'=> $faker->ean13,
        'price' => $faker->randomNumber(2),
    ];
});
