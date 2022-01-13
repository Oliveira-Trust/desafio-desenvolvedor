<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionHistory extends Migration
{
    public function up()
    {
        Schema::create('conversion_histories', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->integer('user_id');
            $table->string('coin_to');
            $table->string('money');
            $table->string('type_payment');
            $table->string('price_money');
            $table->string('converted_money');
            $table->string('payment_rate');
            $table->string('cost_conversion');
            $table->string('money_convert');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversion_histories');
    }
}
