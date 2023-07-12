<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_fees', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(1)->comment('1: boleto, 2: card');
            $table->decimal('fee', 10, 2)->comment('Payment fee');
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
        Schema::dropIfExists('payment_fees');
    }
}
