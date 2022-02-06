<?php

namespace Database\Seeders;

use App\Models\Config;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Config::create([]);

        $firstAdminUser = json_decode(env('FIRST_ADMIN_USER_JSON_DATA'), true);
        $firstAdminUser['api_token'] = Str::random(60);
        User::create($firstAdminUser);
    }
}
