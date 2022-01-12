<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\User\Models\User;

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
            'name'     => 'Matt Murdock',
            'email'    => 'admin@trust.com',
            'type'     => 'admin',
            'password' => bcrypt('123456789')
        ]);

        User::create([
            'name'     => 'Karen Page',
            'email'    => 'karen@trust.com',
            'password' => bcrypt('123456789')
        ]);
    }
}
