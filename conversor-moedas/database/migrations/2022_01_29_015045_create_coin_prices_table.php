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
            $table->foreignId('coin_base_id')
                ->constrained('users')
                ->references('id')->on('users')
                ->cascadeOnDelete();
            $table->foreignId('coin_convert_id')
                ->constrained('users')
                ->references('id')->on('users')
                ->cascadeOnDelete();
            $table->float('value');
            $table->date('reference');
            $table->timestamps();
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
