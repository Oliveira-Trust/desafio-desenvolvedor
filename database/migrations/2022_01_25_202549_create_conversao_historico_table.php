<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversaoHistoricoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversao_historico', function (Blueprint $table) {
            
            $table->increments('id')->unsigned()->index();
            $table->integer('idUsuario')->unsigned()->nullable();
            $table->string('strMoedaOrigem');
            $table->string('strMoedaDestino');
            $table->float('flValorConversao',8,2)->default(0);
            $table->string('strFormaPagamento');
            $table->float('flValorMoedaDestinoConversao',8,2)->default(0);
            $table->float('flValorCompradoMoedaDestino',8,2)->default(0);
            $table->float('flTaxaPagamento',8,2)->default(0);
            $table->float('flTaxaConversao',8,2)->default(0);
            $table->float('flValorUtilizadoConversao',8,2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('idUsuario')->references('id')->on('users')->onDelete('Cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversao_historico');
    }
}
