<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensPedidosComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_pedidos_compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_compra_id');
            $table->foreignId('produto_id');
            $table->integer('quantidade');
            $table->decimal('preco');
            $table->timestamps();

            $table->foreign('pedido_compra_id')->references('id')->on('pedidos_compras')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('itens_pedidos_compras');
    }
}
