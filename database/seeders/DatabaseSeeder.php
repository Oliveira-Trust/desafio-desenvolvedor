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

        \App\Models\Coins::create(
            ['symbol' => 'BRL']
        );
        \App\Models\Coins::create(
            ['symbol' => 'USD']
        );
        \App\Models\Coins::create(
            ['symbol' => 'EUR']
        );
        \App\Models\Coins::create(
            ['symbol' => 'GBP']
        );
        \App\Models\Coins::create(
            ['symbol' => 'CNY']
        );

        \App\Models\FormOfPayment::create(
            ['name' => 'Boleto','rate' => 1.45]
        );

        \App\Models\FormOfPayment::create(
            ['name' => 'Cartão de Crédito','rate' => 7.63]
        );

        \App\Models\User::create(
            ['name' => 'Teste',
             'email' => 'teste@oliveiratrust.com.br',
             'password' => bcrypt('teste@123')]
        );

        // \App\Models\User::factory(10)->create();
    }
}
