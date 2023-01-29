<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->string('currency', 30);
            $table->string('method', 30);
            $table->decimal('ammount', 9);
            $table->decimal('ammount_fee', 6);
            $table->decimal('method_fee', 6);
            $table->decimal('net_ammount', 9);
            $table->decimal('exchange_rate', 6);
            $table->decimal('converted_ammount', 9);
            $table->foreignId('user_id')->constrained();
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
        Schema::table('exchanges', function (Blueprint $table) {
            //
        });
    }
};
