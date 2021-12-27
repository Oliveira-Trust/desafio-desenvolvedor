<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Config;
use Faker\Generator as Faker;

$factory->define(Config::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'taxa_conversao' => 2,
        'taxa_pagamento_boleto' => 1.45,
        'taxa_pagamento_cartao' => 7.63
    ];
});
