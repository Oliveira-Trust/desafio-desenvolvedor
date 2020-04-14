<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        
        \DB::table('users')->insert([
            'id' => 1,
            'name' => 'User',
            'email' => 'user@teste.com',
            'password' => \Hash::make('1234'),
            'avatar' => '',
            'auth_token' => '',
            'created_at' => '2020-02-15 04:28:14',
            'updated_at' => '2020-02-15 04:31:03',
        ]);
    }
}
