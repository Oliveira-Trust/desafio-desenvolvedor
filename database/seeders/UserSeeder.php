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
            'name' => 'Administrador do Sistema',
            'email' => 'admin@email.com',
            'password' => bcrypt('12345678')
        ]);

        \App\Models\User::create([
            'name' => 'Usuário do Sistema',
            'email' => 'user@email.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
