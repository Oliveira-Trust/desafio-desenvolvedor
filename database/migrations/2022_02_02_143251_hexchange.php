<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Hexchange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hexchange', function (Blueprint $table) {
            $table->id();
            $table->text('cur_origim');
            $table->text('cur_destiny');
            $table->text('val_input');
            $table->text('mhd_payment');
            $table->text('val_cur_destiny');
            $table->text('val_buy');
            $table->text('rate_payment');
            $table->text('rate_conversion');
            $table->text('discont_onversion');
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
        Schema::dropIfExists('hexchange');
    }
}
