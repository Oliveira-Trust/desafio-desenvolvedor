<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cotacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacao', function (Blueprint $table) {
            $table->id();
            $table->string('moeda_origem')->index();
            $table->string('moeda_destino');
            $table->double('taxa_conversao');
            $table->double('taxa_forma_pagamento');
            $table->double('valor_liquido');
            $table->double('valor_bruto');
            $table->double('valor_moeda_destino');
            $table->string('forma_pagamento');
            $table->unsignedBigInteger('id_user')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotacao');
    }
}