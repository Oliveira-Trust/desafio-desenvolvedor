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
        Schema::create('exchange_fees', function (Blueprint $table) {
            $table->id();
            $table->decimal("amount_min", 16, 6);
            $table->decimal("amount_max", 16, 6);
            $table->decimal("fee", 9, 6);
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
        Schema::dropIfExists('exchange_fees');
    }
};
