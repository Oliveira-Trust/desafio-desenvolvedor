<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxas_conversao', function (Blueprint $table) {
            $table->id();
            $table->decimal('taxa', 10, 4);
            $table->decimal('valorMin', 10, 4);
            $table->decimal('valorMax', 10, 4);
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
        Schema::dropIfExists('taxas_conversao');
    }
};
