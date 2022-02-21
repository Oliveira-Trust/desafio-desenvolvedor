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
        Schema::table('cotacao', function (Blueprint $table) {
            $table->float('valor_moeda_destino');
            $table->float('valor_comprado_moeda_destino');
            $table->float('taxa_pagamento');
            $table->float('taxa_conversao');
            $table->float('valor_conversao_desconto_taxas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cotacao', function (Blueprint $table) {
            //
        });
    }
};
