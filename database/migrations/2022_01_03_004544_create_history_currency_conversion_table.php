<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHistoryCurrencyConversionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_currency_conversion', function (Blueprint $table) {
            $table->id();
            $table->string('moeda_origin');
            $table->string('moeda_destino');
            $table->string('forma_pagamento');
            $table->float('taxa_pagamento');
            $table->float('taxa_conversao');
            $table->float('valor_conversao');
            $table->float('valor_com_taxa');
            $table->float('valor_sem_taxa');
            $table->float('valor_convertido');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('history_currency_conversion');
    }
}
