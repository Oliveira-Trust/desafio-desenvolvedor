<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'Administrador', 'email' => 'admin@admin.com', 'password' => bcrypt('password'), 'admin' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], 
            ['id' => 2, 'name' => 'Cliente', 'email' => 'cliente@example.com', 'password' => bcrypt('password'), 'admin' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()], 
        ]);
    }
}
