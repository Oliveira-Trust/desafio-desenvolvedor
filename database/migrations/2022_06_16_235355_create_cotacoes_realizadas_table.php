<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotacoesRealizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacoes_realizadas', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario_id');
            $table->integer('moeda_original');
            $table->integer('moeda_destino');
            $table->double('valor_inicial');
            $table->integer('tipo_pagamento_id');
            $table->double('valor_moeda_destino');
            $table->double('valor_comprado');
            $table->double('valor_taxa_tipo_pagamento');
            $table->double('valor_taxa_conversao');
            $table->double('valor_inicial_taxado');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotacoes_realizadas');
    }
}
