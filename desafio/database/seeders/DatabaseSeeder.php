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
        $this->call(ProfileSeeder::class);
        $this->call(PaymentMethodsSeeder::class);
        $this->call(CoinSeeder::class);
        $this->call(TaxSeeder::class);
        
        \App\Models\User::factory(10)->create();
    }
}
