<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            PermissionsSeeder::class,
            CurrencySeeder::class,
            CurrencyTaxSeeder::class,
        ]);
        

         /*
        *
        * Em produção vai rodar uns factory para teste
        * Role [1, 2, 3, 4] são de Currency Conversion
        */
        $users = \App\Models\User::factory(10)->create();
        $role = \Spatie\Permission\Models\Role::findByid(1);
        $role->users()->attach($users);
        $role = \Spatie\Permission\Models\Role::findByid(2);
        $role->users()->attach($users);
        $role = \Spatie\Permission\Models\Role::findByid(3);
        $role->users()->attach($users);
        $role = \Spatie\Permission\Models\Role::findByid(4);
        $role->users()->attach($users);


         \App\Models\CurrencyConversion::factory(500)->create();
     }
 }