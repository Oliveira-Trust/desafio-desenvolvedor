<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@oliveiratrust.com',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'type' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'Usuário',
            'email' => 'user@oliveiratrust.com',
            'username' => 'user',
            'password' => Hash::make('user'),
            'type' => 'user'
        ]);
    }
}
