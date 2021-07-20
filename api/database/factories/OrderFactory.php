<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order\Order;
use App\Models\Order\OrderProduct;
use App\Models\Customer\Customer;
use App\Models\Product\Product;
// use App\Models\Product\Category;
use App\Models\User;

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

$factory->define(Order::class, function (Faker $faker) {

    return [
        'user_id'   => factory(User::class),
        'customer_id'   => factory(Customer::class),
        'status' => $faker->randomElement(['opened', 'paid', 'canceled'])
    ];
});

$factory->define(OrderProduct::class, function (Faker $faker) {
    return [
        'order_id'   => factory(Order::class),
        'product_id'   => factory(Product::class),
        'quantity' => $faker->randomDigit(),
        'price' => $faker->randomFloat(),
    ];
});
