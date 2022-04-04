<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
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
            $table->enum('comparison_operator', [
                '>',
                '<',
                '>=',
                '<='
            ]);
            $table->float('comparator_value',10, 2);
            $table->float('fee', 5, 2);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => 'ConversionFeesSeeder'
        ]);
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
