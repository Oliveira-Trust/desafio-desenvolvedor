<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product\Product;
use App\Models\Product\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'          => $faker->unique()->word
    ];
});

$factory->define(Product::class, function (Faker $faker) {

    $faker->addProvider(new \Faker\Provider\Color ($faker));

    return [
        'name'          => $faker->unique()->name,
        'category_id'   => factory(Category::class),
        'description'   => $faker->text,
        'size'          => $faker->randomFloat(2, 1, 1000),
        'color'         => $faker->hexcolor,
        'price'         => $faker->randomFloat(2, 1, 1000)
    ];
});
