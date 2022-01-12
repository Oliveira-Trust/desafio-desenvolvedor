<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domain\Currency\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Currency::create([
          'name'   => 'Dolar Canadense',
          'code' => 'CAD'
      ]);

      Currency::create([
          'name'   => 'Euro',
          'code' => 'EUR'
      ]);

      Currency::create([
          'name'   => 'Dolar Americano',
          'code' => 'USD'
      ]);
    }
}
