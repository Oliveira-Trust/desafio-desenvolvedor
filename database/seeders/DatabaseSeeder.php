<?php

namespace Database\Seeders;

use App\Models\Product;
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
        $this->call([
            UserSeeder::class
        ]);

        \App\Models\User::factory(5)->create();
        \App\Models\Product::factory(50)->create();
        \App\Models\Customer::factory(15)->create();
    }
}
