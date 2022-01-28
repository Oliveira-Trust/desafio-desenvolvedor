<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currency_from');
            $table->string('currency_to');
            $table->string('total');
            $table->string('payment_method');
            $table->string('weight_from')->nullable();
            $table->string('weight_to')->nullable();
            $table->string('payment_rate')->nullable();
            $table->string('conversion_rate')->nullable();
            $table->string('buy_to_rate')->nullable();
            $table->string('total_rate')->nullable();
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
        Schema::dropIfExists('prices');
    }
}
