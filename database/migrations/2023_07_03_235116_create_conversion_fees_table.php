<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionFeesTable extends Migration
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
            $table->decimal('reference_value', 10, 2)->comment('The reference value');
            $table->decimal('fee_lower_value', 10, 2)->comment('The fee when the value is lower than the reference');
            $table->decimal('fee_higher_value', 10, 2)->comment('The fee when the value is equal to or higher than the reference');
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
}
