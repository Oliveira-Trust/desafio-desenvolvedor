<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Oliveiratrust\Models\FeeType\FeeType;

class FeeTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FeeType::create(['description' => 'Forma de pagamento']);
        FeeType::create(['description' => 'Taxa de conversão']);
    }
}
