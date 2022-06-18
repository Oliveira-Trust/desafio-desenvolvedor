<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Oliveiratrust\Models\CurrencyPrice\CurrencyPrice;

class CurrencyPriceSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CurrencyPrice::create(['currency_id' => 2, 'price' => 5.30, 'user_id' => 1]);//Dólar
        CurrencyPrice::create(['currency_id' => 3, 'price' => 5.3741, 'user_id' => 1]);//Euro
        CurrencyPrice::create(['currency_id' => 4, 'price' => 6.2591, 'user_id' => 1]);//Libra
    }
}

