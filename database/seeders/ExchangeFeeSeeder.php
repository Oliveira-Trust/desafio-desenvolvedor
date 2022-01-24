<?php

namespace Database\Seeders;

use App\Models\ExchangeFee;
use Illuminate\Database\Seeder;

class ExchangeFeeSeeder extends Seeder
{
    public function run()
    {
       $this->getFees()->each(function ($fee) {
           ExchangeFee::create($fee);
       });
    }

    public function getFees()
    {
        return collect([
            [
                'min_amount' => '1000',
                'max_amount' => '3000',
                'fees' => 2,
            ],
            [
                'min_amount' => '3001',
                'max_amount' => '100000',
                'fees' => 1,
            ]
        ]);
    }
}
