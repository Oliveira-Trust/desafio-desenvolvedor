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
        // \App\Models\User::factory(10)->create();
        
        // Seeders obrigatórios
        /* $this->call(StateSeeder::class);
        $this->call(CitySeeder::class); */

        // Seeders opcionais (se não usar esses, usar as factories abaixo)
       /*  $this->call(UserSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class); */

        for ($i=0; $i < 100; $i++) { 
            $user = User::factory()->create();

            $client = Client::factory()
                ->for($user)
                ->create();
        }


    }
}
