<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder {
    public function run() {

        $this->command->getOutput()->info("Seeding fees");

        Fee::insert([
            [
                'starting_value' => 1000,
                'fee_rate'       => 2.0,
            ],
            [
                'starting_value' => 3000,
                'fee_rate'       => 1.0,
            ],
        ]);
    }
}
