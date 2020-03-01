<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        factory(User::class, 5)->create()->each(function ($user) {
            factory(Client::class, rand(11, 15))->make()->each(function ($client) use ($user){
                $user->clients()->save($client);
            });
        });
    }
}
