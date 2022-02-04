<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class People extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('brithday_age');
            $table->integer('weight');
            $table->integer('height');
            $table->text('career');
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
        Schema::dropIfExists('peoples');
    }
}
