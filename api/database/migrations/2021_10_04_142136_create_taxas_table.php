<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moeda_id');
            $table->float('taxaConversaoMin', 8, 2);
            $table->float('taxaConversaoMax', 8, 2);
            $table->float('valor_controle', 8, 2);
            $table->float('taxaCartao', 8, 2);
            $table->float('taxaBoleto', 8, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('moeda_id')->references('id')->on('moedas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxas');
    }
}
