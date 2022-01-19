<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_amount',12,2);
            $table->decimal('max_amount',12,2);
            $table->decimal('target_amount',12,2);
            $table->decimal('rate_min',12,5);
            $table->decimal('rate_max',12,5);
            $table->decimal('rate_bankslips',12,5);
            $table->decimal('rate_credit_card',12,5);         
            
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
        Schema::dropIfExists('rates');
    }
}
