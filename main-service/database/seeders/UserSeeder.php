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
        User::create([
            'name'     => 'Admin',
            'role'     => 'admin',
            'email'    => 'admin@email.com',
            'password' => 'secret',
        ]);

        User::create([
            'name'     => 'User',
            'role'     => 'user',
            'email'    => 'user@email.com',
            'password' => 'secret',
        ]);
    }
}
