<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'Cartão de crédito', 'fee' => 7.63, 'status' => true),
            array('name' => 'Boleto', 'fee' => 1.45, 'status' => true),
        );

        foreach ($data as $value) {
            PaymentType::query()->updateOrInsert(
                ['name' => $value['name']],
                $value
            );
        }
    }
}
