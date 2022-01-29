<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CurrencyTradeAddFeesValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currency_trades', function (Blueprint $table) {
            $table->double('payment_method_fee_value', 8, 2);
            $table->double('amount_fee_value', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('currency_trades', function (Blueprint $table) {
            //
        });
    }
}
