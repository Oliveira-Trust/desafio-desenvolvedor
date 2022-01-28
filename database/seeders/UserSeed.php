<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Caio LK',
            'email' => 'caio.kozano@live.com',
            'blAdmin' => true,
            'password' => Hash::make('teste123')
        ]);
        DB::table('users')->insert([
            'name' => 'testse',
            'email' => 'caaa@live.com',
            'blAdmin' => false,
            'password' => Hash::make('teste123')
        ]);
    }
}
