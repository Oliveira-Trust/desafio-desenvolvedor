<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->decimal('boleto', 8, 4)->default(0.0145);
            $table->decimal('credit_card', 8, 4)->default(0.0763);
            $table->decimal('less_than_3000', 8, 4)->default(0.02);
            $table->decimal('more_than_3000', 8, 4)->default(0.01);
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
        Schema::dropIfExists('fees');
    }
};
