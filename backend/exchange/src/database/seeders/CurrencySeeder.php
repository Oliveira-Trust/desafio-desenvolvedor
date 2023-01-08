<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder {
    public function run() {

        $this->command->getOutput()->info("Seeding currencies");

        Currency::insert([
            [
                'code'             => 'BRL',
                'name'             => 'Real Brasileiro',
                'available_to_buy' => false,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'code'             => 'USD',
                'name'             => 'Dólar Americano',
                'available_to_buy' => true,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
            [
                'code'             => 'EUR',
                'name'             => 'Euro',
                'available_to_buy' => true,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
