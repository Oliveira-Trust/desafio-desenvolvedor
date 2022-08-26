<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\User::create([
            'id' => 1,
            'name' => 'Administrador do Sistema',
            'email' => 'admin@email.com',
            'password' => bcrypt('12345678'),
            'admin' => true
        ]);

        \App\Models\User::create([
            'id' => 2,
            'name' => 'Usuário do Sistema',
            'email' => 'user@email.com',
            'password' => bcrypt('12345678'),
            'admin' => false
        ]);
    }
}
