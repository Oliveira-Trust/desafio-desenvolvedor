<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer\Customer;
use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Person as FakerPerson;
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

$factory->define(Customer::class, function (Faker $faker) {
    $faker->addProvider(new FakerPerson ($faker));
    return [
        'name'      => $faker->name,
        'email'     => $faker->unique()->safeEmail,
        'cpf'       => $faker->cpf,
        'phone'     => $faker->tollFreePhoneNumber,
        'address'   => $faker->address
    ];
});
