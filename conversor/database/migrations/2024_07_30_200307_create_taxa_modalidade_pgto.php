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
        Schema::create('taxa_modalidade_pgto', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_pagamento', ['Boleto', 'Cartão de Crédito']);
            $table->double('taxa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxa_modalidade_pgto');
    }
};
