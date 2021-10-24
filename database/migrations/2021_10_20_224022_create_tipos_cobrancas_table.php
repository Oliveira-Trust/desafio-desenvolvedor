<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposCobrancasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_cobrancas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_tipo_cobranca', 6000);
            $table->integer('ind_status');            
            $table->timestamps();
            $table->unique(['nom_tipo_cobranca']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_cobrancas');
    }
}
