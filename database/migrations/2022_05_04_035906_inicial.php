<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inicial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('isocode');
            $table->boolean('default')->default(false);
            $table->timestamps();
        });

        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->decimal('value',10,2);
            $table->timestamps();
        });

        Schema::create('conversion_taxes', function (Blueprint $table) {
            $table->id();
            $table->decimal('from',10,2);
            $table->decimal('to',10,2);
            $table->bigInteger('tax_id')->unsigned();
            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->timestamps();
        });

        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('tax_id')->unsigned();
            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->timestamps();
        });

        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('currency_id')->unsigned();
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->bigInteger('payment_method_id')->unsigned();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');            
            $table->decimal('ask',10,2);
            $table->decimal('rate',10,2);
            $table->decimal('payment_tax',10,2);
            $table->decimal('conversion_tax',10,2);            
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
        Schema::dropIfExists('exchanges');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('conversion_taxes');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('taxes');
    }
}
