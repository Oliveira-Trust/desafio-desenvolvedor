<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotacaoPrecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacao_preco', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('meio_pagamento_id');
            $table->foreign('meio_pagamento_id')
                ->references('id')
                ->on('meios_pagamento')
                ->onDelete('cascade');

            $table->string('origem_moeda');
            $table->string('destino_meda');
            $table->double('valor');
            $table->double('valor_moeda');
            $table->double('preco_compra');
            $table->double('taxa_pagamento');
            $table->double('taxa_conversao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotacao_preco');
    }
}
