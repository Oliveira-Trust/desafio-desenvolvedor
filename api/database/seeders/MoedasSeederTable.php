<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Moedas;
use Illuminate\Support\Facades\Hash;

class MoedasSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Moedas::create(["nome"=>"Real Brasileiro","sigla"=>"BRL"]);
        Moedas::create(["nome"=>"Dolar Americano","sigla"=>"USD"]);
        Moedas::create(["nome"=>"Euro","sigla"=>"EUR"]);
    }
}
