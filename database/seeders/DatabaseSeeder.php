<?php

namespace Database\Seeders;

use App\Models\CurrencyConversion;
use App\Models\User;
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
        User::factory(2)->create()->each(function ($user) {
            CurrencyConversion::factory(5)->create(['user_id' => $user->id]);
        });
    }

    
}
