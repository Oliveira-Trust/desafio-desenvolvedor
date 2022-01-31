<?php

use Illuminate\Database\Seeder;
use App\EloquentModels\Admin\User;
use Illuminate\Support\Facades\Hash;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo __CLASS__ . "\n";
        $this->createAdmins();

    }

    private function createAdmins()
    {
    	$password = Hash::make('secret');
        $data = [
            [
                "name"         => "Administrador",
                "email"        => "administrador@system-admin.com",
                'password'     => $password,// secret
            ],
        ];
        foreach ($data as $userData) {
            User::create($userData);
        }
    }


}
