<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoDetalhesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_detalhes', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor');
            $table->foreignId('produtos_id')->constrained();
            $table->foreignId('pedidos_id')->constrained();
            $table->timestamp('criado_em')->useCurrent();
            $table->timestamp('alterado_em')->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_detalhes');
    }
}
