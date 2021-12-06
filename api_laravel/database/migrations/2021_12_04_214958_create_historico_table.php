<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->float('taxa_conversao', 8,2);
            $table->float('taxa_pagamento', 8,2);
            $table->float('moeda_destino', 8,2);
            $table->float('moedas_comprada', 8,2);
            $table->float('total_conversao', 8,2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void 
     */
    public function down()
    {
        Schema::dropIfExists('historico');
    }
}
