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
        Schema::create('conversoes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('moedadaOrigem');
            $table->string('moedaDestino');
            $table->decimal('valorConversao');
            $table->string('formaPagamento');
            $table->decimal('valorMoedaDestino');
            $table->decimal('valorComprado');
            $table->decimal('taxaPagamento');
            $table->decimal('taxaConversao');
            $table->decimal('valorUtilizado');
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
