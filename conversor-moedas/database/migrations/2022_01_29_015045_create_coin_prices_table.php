<?php

use App\Models\Coin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_prices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(Coin::class, 'coin_base_id')
                ->constrained('coins')
                ->cascadeOnDelete();
            $table->foreignIdFor(Coin::class, 'coin_convert_id')
                ->constrained('coins')
                ->cascadeOnDelete();

            $table->string('name');
            $table->float('value');
            $table->date('reference')->index();

            $table->unique(['coin_base_id', 'coin_convert_id', 'reference']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_prices');
    }
}
