<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => 'Queijo - '.$faker->colorName,
        'price' => $faker->randomFloat(2, 8, 50),
    ];
});
