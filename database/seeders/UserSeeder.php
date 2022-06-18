<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Oliveiratrust\Models\User\User::create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'password' => 'admin',
            'is_admin' => true
        ]);

        \Oliveiratrust\Models\User\User::factory(2)->create();
    }
}
