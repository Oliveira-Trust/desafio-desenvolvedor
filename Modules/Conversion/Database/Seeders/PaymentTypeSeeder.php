<?php

namespace Modules\Conversion\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Conversion\Models\PaymentType;

class PaymentTypeSeeder extends Seeder {

    public function run() {
        PaymentType::create([
            'name' => 'Boleto',
            'tax' => 1.45
        ]);

        PaymentType::create([
            'name' => 'Cartão de Crédito',
            'tax' => 7.63
        ]);
    }
}
