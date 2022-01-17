<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormaPgtosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_pgtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->decimal('taxa', 5, 5);
            $table->boolean('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forma_pgtos');
    }
}
