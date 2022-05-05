<?php

namespace Database\Seeders;

use App\Models\Tax;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tax = Tax::where('slug', 'billet')->first();

        $exchange_tax = new PaymentMethod();
        $exchange_tax->name = 'Boleto Bancário';
        $exchange_tax->tax_id = $tax->id;
        $exchange_tax->save();

        $tax = Tax::where('slug', 'cc')->first();

        $exchange_tax = new PaymentMethod();
        $exchange_tax->name = 'Cartão de Crédito';
        $exchange_tax->tax_id = $tax->id;
        $exchange_tax->save();
    }
}
