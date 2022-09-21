<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversoes', function (Blueprint $table) {
            $table->id();
            $table->integer('usuario_id');
            $table->string('moeda_origem', 3);
            $table->string('moeda_destino', 3);
            $table->float('valor_solicitado');
            $table->string('forma_pagamento', 50);
            $table->float('cotacao_moeda_destino');
            $table->float('valor_convertido');
            $table->float('taxa_pagamento');
            $table->float('taxa_conversao');
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
        Schema::dropIfExists('conversoes');
    }
}
