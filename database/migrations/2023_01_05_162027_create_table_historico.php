<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('moeda_origem');
            $table->string('moeda_destino');
            $table->decimal('valor', 10, 2);
            $table->string('pagamento_tipo');
            $table->decimal('valor_moeda', 10, 2);
            $table->decimal('valor_conversao', 10, 2);
            $table->decimal('valor_convertido', 10, 2);
            $table->decimal('moeda_comprada', 10, 2);
            $table->decimal('taxa_pagamento', '8', 4);
            $table->decimal('taxa_conversao', '8', 4);
            $table->decimal('taxa_total', '8', 4);
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
        Schema::dropIfExists('historico');
    }
};
