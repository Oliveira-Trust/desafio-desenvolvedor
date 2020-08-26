<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoProdutosTable extends Migration
{
    public function up()
    {
        Schema::create('pedido_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produto_id')->nullable(false);
            $table->integer('pedido_id')->nullable(false);
            $table->integer('produto_quant')->nullable(false)->default(1);
			$table->foreign('produto_id')->references('id')->on('produtos');
			$table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
        });
    }
	
    public function down()
    {
        Schema::dropIfExists('pedido_produtos');
    }
}
