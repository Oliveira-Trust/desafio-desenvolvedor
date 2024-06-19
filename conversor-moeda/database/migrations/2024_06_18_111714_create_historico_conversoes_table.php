<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoConversoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_conversoes', function (Blueprint $table) {
            $table->id();
            $table->string('moeda_origem');
            $table->string('moeda_destino');
            $table->decimal('valor_para_conversao', 15, 2);
            $table->string('forma_pagamento');
            $table->decimal('bid_destino', 15, 6);
            $table->decimal('valor_comprado', 15, 2);
            $table->decimal('taxa_pagamento', 15, 2);
            $table->decimal('taxa_conversao', 15, 2);
            $table->decimal('valor_utilizado_para_conversao', 15, 2);
            $table->timestamps(); // Adiciona colunas created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_conversoes');
    }
}

