<?php

namespace Database\Seeders;

use App\Models\Coin;
use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{

    /**
     * List coins
     * @var $coin
     */
    private $coins = [
        'USD', 
        'EUR', 
        'BTC', 
        'ETH'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->coins as $coin) {
            Coin::create([
                'acronym' => $coin
            ]);
        }
    }
}
