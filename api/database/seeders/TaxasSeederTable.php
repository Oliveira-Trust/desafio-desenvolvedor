<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Taxas;
use Illuminate\Support\Facades\Hash;

class TaxasSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Taxas::create(['moeda_id'=>1,'valor_controle'=> 3000.0,'taxaConversaoMin'=> 1.0,'taxaConversaoMax'=>2.0,'taxaCartao'=>7.63,'taxaBoleto'=>1.45]);
        Taxas::create(['moeda_id'=>2,'valor_controle'=> 3000.0,'taxaConversaoMin'=> 1.0,'taxaConversaoMax'=>2.0,'taxaCartao'=>7.63,'taxaBoleto'=>1.45]);
        Taxas::create(['moeda_id'=>3,'valor_controle'=> 3000.0,'taxaConversaoMin'=> 1.0,'taxaConversaoMax'=>2.0,'taxaCartao'=>7.63,'taxaBoleto'=>1.45]);
    }
}
