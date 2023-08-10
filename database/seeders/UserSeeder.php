<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run() {
        User::create([
            'name'     => 'Admin',
            'username' => 'admin',
            'email'    => 'admin@email.com.br',
            'password' => \Hash::make('12345679')
        ]);
    }
}
