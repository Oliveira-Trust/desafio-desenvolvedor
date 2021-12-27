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
        /**
         * Adson Souza
         * Este modelo de dados pode ser melhorado informando os tamanhos das colunas e os tipos, mas devido
         * ao tempo não achei crucial no momento
         */
        Schema::create('historicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('moeda_origem');
            $table->string('moeda_destino');
            $table->string('valor_conversao_original');
            $table->string('forma_pagamento');
            $table->string('valor_moeda');
            $table->string('valor_comprado');
            $table->string('valor_taxa_pagamento');
            $table->string('valor_taxa_conversao');
            $table->string('valor_conversao_com_taxa');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');

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
        Schema::dropIfExists('users');
    }
}
