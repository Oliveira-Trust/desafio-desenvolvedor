<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CurrencyTax;

class CurrencyTaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Date = \Carbon\Carbon::now();

        $Data  =  [
        'less_value' => 2999.99,
        'less_tax' => 2,
        'bigger_value' => 3000,
        'bigger_tax' => 1,
        'tax_credit_card' => 1.45,
        'tax_bank_slip' => 7.63,
        'created_at' => $Date, 
        'updated_at' => $Date,
        ];
        CurrencyTax::insert($Data);
    }
}