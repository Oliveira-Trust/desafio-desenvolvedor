<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type')->nullable();

            $table->bigInteger('payment_tax')->unsigned();;
            $table->integer('conversion_tax')->unsigned();;

            $table->bigInteger('currency_origin_value')->unsigned();
            $table->bigInteger('currency_origin_value_with_tax')->unsigned();;
            $table->string('currency_origin_name');
            $table->string('currency_origin_symbol');

            $table->bigInteger('currency_destiny_value')->unsigned();
            $table->string('currency_destiny_name');
            $table->bigInteger('currency_destiny_conversion')->unsigned();
            $table->string('currency_destiny_symbol');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('conversions');
    }
};
