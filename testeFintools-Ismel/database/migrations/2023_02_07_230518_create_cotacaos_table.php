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
        Schema::create('cotacaos', function (Blueprint $table) {
            $table->id();
            $table->string('moeda_origem');
            $table->string('moeda_destino');
            $table->integer('valor_conversao');
            $table->string('forma_pagamento');
            $table->float('valor_usado_conversao');
            $table->float('valor_comprado');
            $table->float('taxa_pagamento');
            $table->float('taxa_conversao'); 
            $table->date('data_transacao');
            $table->foreignId('user_id')->constrained();            
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
