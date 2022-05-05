<?php

namespace Database\Seeders;

use App\Models\ExchangeTax;
use App\Models\Tax;
use Illuminate\Database\Seeder;

class ExchangeTaxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tax = Tax::where('slug', 'exchange_two')->first();

        $exchange_tax = new ExchangeTax();
        $exchange_tax->from = 1000;
        $exchange_tax->to = 3000;
        $exchange_tax->tax_id = $tax->id;
        $exchange_tax->save();

        $tax = Tax::where('slug', 'exchange_one')->first();

        $exchange_tax = new ExchangeTax();
        $exchange_tax->from = 3000.01;
        $exchange_tax->to = 100000;
        $exchange_tax->tax_id = $tax->id;
        $exchange_tax->save();
    }
}
