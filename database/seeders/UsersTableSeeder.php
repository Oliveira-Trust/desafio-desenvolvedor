<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->createUsers();
    }

    public function createUsers(){
        DB::table('users')
            ->insert([
                'name' => 'Daniel Hashimoto',
                'email' => 'linkhashimoto@hotmail.com',
                'email_verified_at' => null,
                'password' => Hash::make(1234),
            ]);

    }
}
