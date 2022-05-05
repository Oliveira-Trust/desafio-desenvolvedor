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
        $this->call(CurrenciesSeeder::class);   
        $this->call(PermissionsSeeder::class);
        $this->call(UsersSeeder::class);   
        $this->call(TaxesSeeder::class);   
        $this->call(ExchangeTaxesSeeder::class);   
        $this->call(PaymentMethodsSeeder::class);   
    }
}
