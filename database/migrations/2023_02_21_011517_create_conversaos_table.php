<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversoes', function (Blueprint $table) {
            $table->id();
            $table->uuid('_ID');
            $table->string('moeda_origem');
            $table->string('moeda_destino');
            $table->decimal('valor_compra', 10, 4);
            $table->string('forma_pgto');
            $table->decimal('perc_taxa_pgto', 10, 4);
            $table->decimal('taxa_pagamento', 10, 4);
            $table->decimal('perc_taxa_conversao', 10, 4);
            $table->decimal('taxa_conversao', 10, 4);
            $table->decimal('saldo_conversao', 10, 4);
            $table->decimal('valor_cotacao', 10, 4);
            $table->decimal('valor_convertido', 10, 4);
            $table->dateTime('data');

            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('conversoes');
    }
};
