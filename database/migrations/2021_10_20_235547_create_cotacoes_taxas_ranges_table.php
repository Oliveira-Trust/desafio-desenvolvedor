<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotacoesTaxasRangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacoes_taxas_ranges', function (Blueprint $table) {
            $table->bigInteger('cotacao_taxa_id')->unsigned();
            $table->double('val_minimo', 8, 2)->nullable();
            $table->double('val_maximo', 8, 2)->nullable();
            $table->integer('ind_status');
            $table->timestamps();
            $table->unique(['cotacao_taxa_id']);
            $table->foreign('cotacao_taxa_id')->references('id')->on('cotacoes_taxas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotacoes_taxas_ranges');
    }
}
