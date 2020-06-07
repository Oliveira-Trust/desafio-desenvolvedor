<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('pedido_ident')->nullable();
            $table->date('pedido_data')->nullable();

            /*
            *   RELAÇÃO DE PEDIDO
            */
            $table->integer('cliente_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->integer('condicoes_id')->unsigned();

            /*
            *   REFERENCIA DAS RELAÇÕES
            */
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('condicoes_id')->references('id')->on('condicoes');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pedidos');
    }
}
