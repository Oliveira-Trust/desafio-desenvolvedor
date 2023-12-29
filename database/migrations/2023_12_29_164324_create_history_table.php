<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('valor_investido');
            $table->string('moeda_selecionada');
            $table->string('valor_unitario');
            $table->string('valor_convertido');
            $table->string('taxa_boleto');
            $table->string('taxa_cartao');
            $table->string('metodo_pagamento');
            $table->string('valor_final_taxado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
