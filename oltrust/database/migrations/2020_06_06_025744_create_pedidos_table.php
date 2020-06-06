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
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('pedido_ident')->nullable();
            $table->date('pedido_data')->nullable();
            
            //Relação
            $table->integer('cliente_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            
            $table->string('pedido_status');
            
            //Referencia
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('produto_id')->references('id')->on('produtos');
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
