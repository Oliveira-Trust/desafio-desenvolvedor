<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Oliveiratrust\Models\Fee\Fee;
use Oliveiratrust\Models\FeeType\FeeType;
use Oliveiratrust\Models\PaymentType\PaymentType;

class FeeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fee::create([
            'fee_type_id'     => FeeType::FORMA_DE_PAGAMENTO,
            'payment_type_id' => PaymentType::BOLETO,
            'min_amount'      => 0,
            'max_amount'      => 100000.00,
            'percent'         => 1.45,
            'fixed_value'     => 0
        ]);

        Fee::create([
            'fee_type_id'     => FeeType::FORMA_DE_PAGAMENTO,
            'payment_type_id' => PaymentType::CARTAO_DE_CREDITO,
            'min_amount'      => 0,
            'max_amount'      => 100000.00,
            'percent'         => 7.63,
            'fixed_value'     => 0
        ]);

        Fee::create([
            'fee_type_id' => FeeType::TAXAS_DE_CONVERSAO,
            'min_amount'  => 0,
            'max_amount'  => 2999.99,
            'percent'     => 2.00,
            'fixed_value' => 0
        ]);

        Fee::create([
            'fee_type_id' => FeeType::TAXAS_DE_CONVERSAO,
            'min_amount'  => 3000.00,
            'max_amount'  => 100000.00,
            'percent'     => 1.00,
            'fixed_value' => 0
        ]);
    }
}
