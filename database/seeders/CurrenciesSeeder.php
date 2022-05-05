<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = new Currency();
        $currency->isocode = 'BRL';
        $currency->name = 'Real Brasileiro';
        $currency->default = true;
        $currency->save();

        $xml_string = Storage::get('currencies.xml');
        $xml = simplexml_load_string($xml_string);
        foreach($xml as $key => $value){
            $currency = new Currency();
            $currency->isocode = $key;
            $currency->name = $value;
            $currency->save();
        }
    }
}
