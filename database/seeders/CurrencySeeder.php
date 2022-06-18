<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Oliveiratrust\Models\Currency\Currency;

class CurrencySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create(['code' => 'BRL', 'name' => 'Real Brasileiro', 'active' => false]);
        Currency::create(['code' => 'USD', 'name' => 'Dólar Americano']);
        Currency::create(['code' => 'EUR', 'name' => 'Euro']);
        Currency::create(['code' => 'GBP', 'name' => 'Libra Esterlina']);
    }
}
