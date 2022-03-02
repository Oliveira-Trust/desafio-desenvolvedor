<?php

namespace Database\Seeders;

use App\Models\MeiosPagamento;
use App\Models\TaxasConversao;
use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        TaxasConversao::create([
            'valor' => 3000,
            'tipo' => 'maior',
            'taxa' => 1,
        ]);

        TaxasConversao::create([
            'valor' => 3000,
            'tipo' => 'menor',
            'taxa' => 2,
        ]);

        MeiosPagamento::create([
            'meio_pagamento' => 'Cartão de crédito',
            'taxa' => 7.63,
        ]);

        MeiosPagamento::create([
            'meio_pagamento' => 'Boleto',
            'taxa' => 1.45,
        ]);
    }
}
