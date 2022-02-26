<?php

namespace Database\Seeders;

use App\Models\Tax;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * List fees
     * @var $fees
     */
    private $fees = [
        [
            'tax' => 1.45,
            'payment_method' => 1
        ],
        [
            'tax' => 7.63,
            'payment_method' => 2
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->fees as $tax) {
            Tax::create([
                'tax' => $tax['tax'],
                'payment_method_id' => $tax['payment_method']
            ]);
        }
    }
}
