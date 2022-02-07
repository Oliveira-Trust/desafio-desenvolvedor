<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacoes', function (Blueprint $table) {
            $table->id();
            $table->string('moeda_origem', 3);
            $table->string('moeda_destino', 3);
            $table->decimal('valor_conversao', 15, 2);
            $table->enum('forma_pagamento', ['boleto', 'cartao']);
            $table->decimal('valor_moeda_destino', 15, 2);
            $table->decimal('valor_comprado_moeda_destino', 15, 2);
            $table->decimal('taxa_pagamento', 15, 2);
            $table->decimal('taxa_conversao', 15, 2);
            $table->decimal('valor_conversao_com_taxas', 15, 2);
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
        Schema::dropIfExists('cotacaos');
    }
}
