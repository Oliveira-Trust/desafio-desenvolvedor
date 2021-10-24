<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDominiosItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dominios_itens', function (Blueprint $table) {
            $table->string('dominio_id', 100);
            $table->bigInteger('val_dominio_item');
            $table->string('dsc_dominio_item', 4000);
            $table->unique(['dominio_id', 'val_dominio_item']);
            $table->timestamps();
            $table->foreign('dominio_id')->references('id')->on('dominios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dominios_itens');
    }
}
