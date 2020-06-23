<?php

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
        $this->call(UserBaseSeeder::class);
        $this->call(StatusBaseSeeder::class);
        $this->call(ClientBaseSeeder::class);
        $this->call(ProductBaseSeeder::class);
    }
}
