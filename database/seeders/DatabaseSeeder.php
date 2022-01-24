<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaymentMethodsSeeder::class);
        $this->call(ExchangeFeeSeeder::class);
        $this->call(UserSeeder::class);
    }
}
