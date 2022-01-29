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
            $table->string('currency_from')->default('BRL');
            $table->string('currency_to');
            $table->decimal('total', 19, 8)->default(0);
            $table->enum('payment_method', ['ticket', 'card']);
            $table->string('weight_from')->nullable();
            $table->string('weight_to')->nullable();
            $table->decimal('payment_rate', 19, 8)->default(0);
            $table->decimal('conversion_rate', 19, 8)->default(0);
            $table->decimal('buy_to_rate', 19, 8)->default(0);
            $table->decimal('total_rate', 19, 8)->default(0);
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
