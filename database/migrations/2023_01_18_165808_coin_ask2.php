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
        //
        Schema::create('coin_asks', function (Blueprint $table) {
            $table->id();
            $table->string('coin_dest');
            $table->string('coin_base');           
            $table->double('value_of');  
            $table->string('payment_method');  
            $table->double('ranting_ask');  
            $table->double('tax_convert');  
            $table->double('tax_payment');  
            $table->double('total_used');  
            $table->double('total_dest');  
            $table->unsignedBigInteger('user_id')->nullable(true);
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
        //
    }
};
