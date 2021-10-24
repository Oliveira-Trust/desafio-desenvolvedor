<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotacoesTaxasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacoes_taxas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tipo_cobranca_id')->unsigned();
            $table->string('dsc_cotacao_taxa', 4000);
            $table->double('per_cotacao_taxa', 3, 2);
            $table->integer('ind_status');
            $table->timestamps();
            $table->foreign('tipo_cobranca_id')->references('id')->on('tipos_cobrancas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotacoes_taxas');
    }
}
