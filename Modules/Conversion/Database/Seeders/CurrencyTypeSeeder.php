<?php

namespace Modules\Conversion\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Conversion\Models\CurrencyType;

class CurrencyTypeSeeder extends Seeder {

    public function run() {
        CurrencyType::create([
            'name'   => 'BRL',
            'full_name' => 'Real Brasileiro',
            'symbol' => 'R$'
        ]);

        CurrencyType::create([
            'name'   => 'USD',
            'full_name' => 'Dólar Americano',
            'symbol' => '$'
        ]);

        CurrencyType::create([
            'name'   => 'BTC',
            'full_name' => 'Bitcoin',
            'symbol' => '₿'
        ]);
    }
}
