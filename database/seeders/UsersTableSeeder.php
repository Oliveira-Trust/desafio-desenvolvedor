<?php

namespace Database\Seeders;

use Auth\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('123')
        ]);
    }
}