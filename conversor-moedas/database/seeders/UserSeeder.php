<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = collect([
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'password',
            ]
        ]);

        $users->each(function (array $user) {
            User::create($user);
        });
    }
}
