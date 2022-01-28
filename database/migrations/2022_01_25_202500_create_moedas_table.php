<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoedasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moedas', function (Blueprint $table) {

            $table->increments('id')->unsigned()->index();
            $table->string('strSiglaMoeda');
            $table->string('strDescricaoMoeda');
            $table->boolean('blOrigem');
            $table->boolean('blDestino');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('moedas');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
