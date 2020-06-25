<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderProducts;
use Faker\Generator as Faker;

$factory->define(OrderProducts::class, function (Faker $faker) {

    return [
        'qnt' => $faker->randomDigitNotNull,
        'price' => $faker->word,
        'order_id' => $faker->word,
        'product_id' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
