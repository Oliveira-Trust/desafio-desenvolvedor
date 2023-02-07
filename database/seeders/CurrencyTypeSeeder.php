<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\CurrencyType;

class CurrencyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CurrencyType::create([
            'code' => 'USD',
            'name' => 'Dólar',
        ]);
        CurrencyType::create([
            'code' => 'EUR',
            'name' => 'Euro',
        ]);
    }
}
