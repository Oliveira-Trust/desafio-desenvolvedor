<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        $this->command->getOutput()->info("Seeding database");

        $this->call(CurrencySeeder::class);

        $this->call(PaymentMethodSeeder::class);

        $this->call(FeeSeeder::class);
    }
}
