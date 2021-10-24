<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCotacoesTaxasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_cotacoes_taxas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_cotacao_id')->unsigned();
            $table->bigInteger('cotacao_taxa_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_cotacao_id')->references('id')->on('users_cotacoes')->onDelete('cascade');
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
        Schema::dropIfExists('users_cotacoes_taxas');
    }
}
