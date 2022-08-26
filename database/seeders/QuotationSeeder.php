<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Quotation::create([
            'target_currency_quote' => 5.30,
            'source_amount' => 5000.00,
            'payment_method_fee_amount' => 50.00,
            'conversion_fee_amount' => 72.50,
            'source_taxed_amount' => 4877.50,
            'target_amount' => 920.18,
            'payment_status' => 'Em aberto',
            'source_currency_id' => 1,
            'target_currency_id' => 2,
            'user_id' => 2,
            'payment_method_id' => 1,
            'conversion_fee_id' => 2,
        ]);
    }
}
