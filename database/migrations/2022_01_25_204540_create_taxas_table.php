<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxas', function (Blueprint $table) {
            $table->id();
            $table->enum('enumTipoTaxa', ['conversao', 'tipo-pagamento']);
            $table->integer('idTipoPagamento')->unsigned()->nullable();;
            $table->double('flTaxa',8,2);
            $table->double('flValorMinTaxa',8,2);
            $table->double('flValorMaxTaxa',8,2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('idTipoPagamento')->references('id')->on('tipo_pagamentos')->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('taxas');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
