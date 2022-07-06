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
        Schema::create('convertion_fees', function (Blueprint $table) {
            $table->id();

            $table->float('base_value');
            $table->float('lt_fee')->comment('deve ser um valor entre 0 e 100');
            $table->float('gt_fee')->comment('deve ser um valor entre 0 e 100');
            $table->boolean('active');

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
        Schema::dropIfExists('convertion_fees');
    }
};
