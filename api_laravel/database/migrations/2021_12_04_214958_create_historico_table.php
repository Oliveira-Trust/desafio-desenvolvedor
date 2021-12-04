<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoTable extends Migration
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

            $table->unsignedBigInteger('user_id');
            $table->float('taxa_conversao', 8,2);
            $table->float('taxa_pagamento', 8,2);
            $table->float('moeda_destino', 8,2);
            $table->float('moedas_comprada', 8,2);
            $table->float('total_conversao', 8,2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    
    // $dataset = [
    //     'taxa_conversao' => $taxa_conversao,
    //     'taxa_pagamento' => $taxa_pagamento,
    //     'moeda_destino' => $moeda_origem,
    //     'moedas_comprada' => $valor_compra,
    //     'total_conversao' =>  $saldo_com_descontos_taxas
    //  ];

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico');
    }
}
