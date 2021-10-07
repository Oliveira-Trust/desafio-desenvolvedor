<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricosTable extends Migration
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
            $table->unsignedBigInteger('usuario_id');
            $table->dateTime('data_cotacao', $precision = 0);
            $table->float('valorEntrada', 8, 2);
            $table->string('moeda_origem');
            $table->string('moeda_destino');
            $table->string('formaPagamento');
            $table->float('valor_moeda_destino', 8, 2);
            $table->float('taxaPagameno', 8, 2);
            $table->float('taxaConversao', 8, 2);
            $table->float('valorPagamento', 8, 2);
            $table->float('valorMoedaDestino', 8, 2);
            $table->tinyInteger('statusCotacao');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('usuario_id')->references('id')->on('usuarios');

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
}
