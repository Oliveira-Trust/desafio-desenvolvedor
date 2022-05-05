<?php

namespace Database\Seeders;

use App\Models\Tax;
use Illuminate\Database\Seeder;

class TaxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tax = new Tax();
        $tax->slug = "exchange_one";
        $tax->name = "Exchange 1%";
        $tax->value = "1";        
        $tax->save();

        $tax = new Tax();
        $tax->slug = "exchange_two";
        $tax->name = "Exchange 2%";
        $tax->value = "2";        
        $tax->save();

        $tax = new Tax();
        $tax->slug = "billet";
        $tax->name = "Billet Tax";
        $tax->value = "1.45";        
        $tax->save();

        $tax = new Tax();
        $tax->slug = "cc";
        $tax->name = "CreditCard Tax";
        $tax->value = "7.63";        
        $tax->save();
    }
}
