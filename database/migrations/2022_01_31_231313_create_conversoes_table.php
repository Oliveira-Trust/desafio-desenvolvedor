<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversoes_moedas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade')->comment('Id da empresa.');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('Id do usuario.');
            $table->double('valor_conversao', 10, 2)->default(0)->comment('Valor a ser convertido.');
            $table->string('moeda_origem',3)->default('BRL')->comment('Moeda de origem.'); 
            $table->string('moeda_destino',3)->comment('Moeda de destino.'); 
            $table->double('valor_moeda_destino', 10, 2)->default(0)->comment('Valor da moeda de destino.');
            $table->double('valor_comprado_moeda_destino', 10, 2)->default(0)->comment('Valor comprado da moeda de destino.');
            $table->enum('forma_pagamento',['B','C'])->comment('B - Boleto , C - Cartão de crédito.'); 
            $table->double('taxa_pagamento', 10, 2)->default(0)->comment('Taxa de pagamento, de acordo com a forma de pagamento.');
            $table->double('taxa_conversao', 10, 2)->default(0)->comment('Taxa de conversao.');
            $table->string('email',100)->nullable()->comment('Email para receber a coração.');
            $table->enum('email_enviado',['S','N'])->default('N')->comment('Seta se email foi enviado ou não.'); 
            $table->double('valor_final_conversao', 10, 2)->default(0)->comment('valor final da conversao com descontos.');
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
        Schema::dropIfExists('conversoes_moedas');
    }
}
