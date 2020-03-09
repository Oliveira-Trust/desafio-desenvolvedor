<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Client;
use App\Product;

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
         factory(User::class, 1)->create()->each(function ($user) {
            factory(Client::class, rand(2, 3))->make()->each(function ($client) use ($user){
                $user->clients()->save($client);
                });
            factory(Product::class, rand(2, 3))->make()->each(function ($product) use ($user){
                $user->products()->save($product);
            });
        });
    }
}
