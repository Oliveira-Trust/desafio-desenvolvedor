<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->count(2)
        ->sequence(
            ['name' => 'João', 'email' => 'joao@email.com', 'password' => bcrypt('12345678')],
            ['name' => 'Maria', 'email' => 'maria@email.com', 'password' => bcrypt('12345678')],
        )->create();

        $this->call([
            FormaPagamentoSeeder::class,
            TaxaConversaoSeeder::class,
            TipoMoedaSeeder::class,
        ]);
    }


}
