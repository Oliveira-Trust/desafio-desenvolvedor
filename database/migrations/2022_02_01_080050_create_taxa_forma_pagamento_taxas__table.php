<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxaFormaPagamentoTaxasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_pagamento_taxas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade')->comment('Id da empresa.');
            $table->enum('tipo',['B','C'])->unique()->comment('B - Boleto , C - Cartão de crédito.'); 
            $table->double('porcentagem', 10, 2)->default(0)->comment('Porcentagem da taxa.');
            $table->enum('ativo',['S','N'])->default('S')->comment('Seta se está ativo ou não.'); 
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
        Schema::dropIfExists('forma_pagamento_taxas');
    }
}
