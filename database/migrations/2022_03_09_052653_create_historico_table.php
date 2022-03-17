<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('moeda_origem_id');
            $table->unsignedBigInteger('moeda_destino_id');
            $table->unsignedBigInteger('forma_id');
            $table->float('percent_taxa_pagamento');
            $table->float('percent_taxa_conversao');
            $table->float('valor_conversao');
            $table->float('valor_taxa_pagamento');
            $table->float('valor_taxa_conversao');
            $table->float('valor_moeda_destino');
            $table->float('valor_comprado');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('moeda_origem_id')->references('id')->on('moedas');
            $table->foreign('moeda_destino_id')->references('id')->on('moedas');
            $table->foreign('forma_id')->references('id')->on('formas');
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
};
