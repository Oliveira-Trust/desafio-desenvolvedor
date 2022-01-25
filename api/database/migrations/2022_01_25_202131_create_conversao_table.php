<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversao', function (Blueprint $table) {
            $table->id();

            $table->string('moeda_origem');
            $table->string('moeda_destino');
            $table->unsignedDouble('valor_conversao');
            $table->string('forma_pagamento');
            $table->double('valor_moeda_destino');
            $table->double('valor_comprado');
            $table->double('taxa_pagamento');
            $table->double('taxa_conversao');
            $table->double('valor_converter');

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
        Schema::dropIfExists('conversao');
    }
}
