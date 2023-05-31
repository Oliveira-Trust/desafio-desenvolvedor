<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotacaoMoedasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacao_moedas', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_conversao', 10, 2);
            $table->integer('forma_pagamento');
            $table->string('moeda_origem');
            $table->string('moeda_destino');        
            $table->decimal('valor_moeda_destino', 10, 2);
            $table->decimal('valor_taxa_pagamento', 10, 2);
            $table->decimal('valor_taxa_conversao', 10, 2);
            $table->decimal('valor_convertido', 10, 2);  
            $table->bigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('cotacao_moedas');
    }
}
