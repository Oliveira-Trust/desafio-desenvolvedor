<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesCharged extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees_charged', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->float('money_min');
            $table->float('money_max');
            $table->float('fee_ticket');
            $table->float('fee_card');
            $table->float('parameter_money');
            $table->float('fee_below');
            $table->float('fee_above');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('fees_charged');
    }
}
