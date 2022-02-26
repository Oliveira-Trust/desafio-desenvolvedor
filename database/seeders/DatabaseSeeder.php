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
            'taxa' => 2,
        ]);

        TaxasConversao::create([
            'valor' => 3000,
            'tipo' => 'menor',
            'taxa' => 1,
        ]);

        MeiosPagamento::create([
            'meio_pagamento' => 'card',
            'taxa' => 7.63,
        ]);

        MeiosPagamento::create([
            'meio_pagamento' => 'billet',
            'taxa' => 1.45,
        ]);
    }
}
