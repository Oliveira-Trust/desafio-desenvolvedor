<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedBigInteger('idProduto');
            $table->unsignedBigInteger('idCliente');
            $table->string('status', 12);
            $table->integer('quantidade');
            $table->decimal('valorTotal',13,2);
            $table->dateTime('dataCompra');

            $table->foreign('idProduto')->references('id')->on('produtos');
            $table->foreign('idCliente')->references('id')->on('clientes');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
