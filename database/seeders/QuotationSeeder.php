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
            'source_currency_acronym' => 'BRL',
            'source_currency_symbol' => 'R$',
            'target_currency_acronym' => 'USD',
            'target_currency_symbol' => '$',
            'target_currency_quote' => 5.30,
            'payment_method_fee_amount' => 50.00,
            'payment_method_fee_percentage' => 1.45,
            'conversion_fee_amount' => 72.50,
            'conversion_fee_percentage' => 2.0,
            'source_amount' => 5000.00,
            'source_taxed_amount' => 4877.50,
            'target_amount' => 920.18,
            'payment_method' => 'Boleto',
            'payment_status' => 'Em aberto',
            'user_id' => 2,
        ]);
    }
}
