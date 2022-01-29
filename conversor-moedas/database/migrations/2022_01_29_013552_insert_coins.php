<?php

use App\Models\Coin;
use Illuminate\Database\Migrations\Migration;

class InsertCoins extends Migration
{
    private array $coins = [
        [ 'name' => 'BRL' ],
        [ 'name' => 'USD' ],
        [ 'name' => 'EUR' ],
        [ 'name' => 'BTC' ],
        [ 'name' => 'DOGE' ]
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->coins as $coin) {
            Coin::create($coin);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Coin::truncate();
    }
}
