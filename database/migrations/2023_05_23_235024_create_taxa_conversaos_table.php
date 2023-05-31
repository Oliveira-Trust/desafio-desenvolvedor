<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxaConversaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxa_conversaos', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_referencia', 10, 2);
            $table->decimal('taxa_maior', 10, 2);
            $table->decimal('taxa_menor', 10, 2);
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
        Schema::dropIfExists('taxa_conversaos');
    }
}
