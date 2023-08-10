<?php

namespace Modules\Conversion\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Conversion\Models\ConversionTax;

class ConversionTaxSeeder extends Seeder {

    public function run() {
        // 0 - 2999.99
        ConversionTax::create([
            'value' => 2,
            'min'   => 0,
            'max'   => 299999
        ]);

        // 3000 - ...
        ConversionTax::create([
            'value' => 1,
            'min'   => 300000,
            'max'   => null
        ]);
    }
}
