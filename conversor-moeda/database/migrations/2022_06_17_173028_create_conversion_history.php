<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_conversoes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id');
            $table->float('valor_real', 11, 2);
            $table->float('valor_moeda', 6, 2);
            $table->string('moeda', 5);
            $table->float('taxa_conversao', 6, 2);
            $table->float('valor_taxa_conversao', 11, 2);
            $table->string('forma_pgto', 20);
            $table->float('taxa_pgto', 11, 2);
            $table->float('valor_taxa_pgto', 11, 2);
            $table->float('valor_para_conversao', 11, 2);
            $table->float('valor_convertido', 11, 2);
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
        Schema::dropIfExists('historico_conversoes');
    }
}
