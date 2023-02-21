<?php

namespace Database\Seeders;

use App\Models\TaxaConversao;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaxaConversaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaxaConversao::factory()->count(2)
        ->sequence(
            ['taxa' => 2, 'valorMin' => 0.01, 'valorMax' => 3000],
            ['taxa' => 1, 'valorMin' => 3000.01, 'valorMax' => 100000],
        )
        ->create();
    }
}
