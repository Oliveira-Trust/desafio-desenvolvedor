<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PaymentSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\HistoricSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CurrencySeeder::class,
            PaymentSeeder::class,
            HistoricSeeder::class
        ]);
    }
}
