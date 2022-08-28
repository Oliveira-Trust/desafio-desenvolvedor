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
        Schema::create('conversion_fees', function (Blueprint $table) {
            $table->id();
            $table->float('fee', 8, 4);
            $table->float('fee_relative_amount');
            $table->foreignIdFor(\App\Models\ConversionFeeMathOperator::class);
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
        Schema::dropIfExists('conversion_fees');
    }
};
