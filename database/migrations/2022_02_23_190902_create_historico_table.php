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
        Schema::create('historicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('moeda_origem');
            $table->string('moeda_destino');
            $table->float('valor_conversao', 8, 2);
            $table->string('forma_pagamento');
            $table->float('valor_moeda_destino', 8, 2);
            $table->float('valor_comprado', 8, 2);
            $table->float('taxa_pagamento', 8, 2);
            $table->float('taxa_conversao', 8, 2);
            $table->float('total_descontato', 8, 2);
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
        Schema::dropIfExists('historicos');
    }
};
