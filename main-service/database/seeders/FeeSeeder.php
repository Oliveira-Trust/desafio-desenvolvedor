<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fee::create([
           'type'        => 'A',
           'range'       => 3000,
           'less_than'   => 2,
           'more_than'   => 1,
           'status'      => 1,
           'description' => 'Taxa 2% pela conversão para valor < R$ 3.000,00 e 1% > 3.000,00.',
        ]);

        Fee::create([
            'type'        => 'B',
            'range'       => 5000,
            'less_than'   => 1.5,
            'more_than'   => 0.5,
            'description' => 'Taxa de 1.5% pela conversão para valor < R$ 5.000,00 e 0.5% > 5.000,00',
        ]);
    }
}
