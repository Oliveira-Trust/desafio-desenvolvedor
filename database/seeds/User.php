<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert( [
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => md5('admin123'),
            'created_at' => getDateNow(),
            'updated_at' => getDateNow(),
        ] );
    }
}
