<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\{User, Client};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seeders obrigatórios
        $this->call([
            AdminSeeder::class,
            StateSeeder::class,
            CitySeeder::class
        ]);


        // Seeders opcionais
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class
        ]);

        for ($i=0; $i < 100; $i++) { 
            $user = User::factory()->create();

            $client = Client::factory()
                ->for($user)
                ->create();
        }

    }
}
