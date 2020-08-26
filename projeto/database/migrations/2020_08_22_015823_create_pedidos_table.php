<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
			$table->increments('id');	
			$table->enum('status', ['Em Aberto', 'Pago', 'Cancelado'])->nullable(false);
			$table->integer('cliente_id')->nullable(false);
			$table->dateTime('data_criacao')->nullable(false);
			$table->dateTime('data_atualizacao')->nullable(false);
			$table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

	
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
