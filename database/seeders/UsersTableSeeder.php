<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Oliveira Trust',
            'email'     => 'oliveira@oliveiratrust.com.br',
            'password'  => bcrypt('123456'),
        ]);
    }
}
