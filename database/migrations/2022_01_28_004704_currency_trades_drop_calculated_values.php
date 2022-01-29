<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CurrencyTradesDropCalculatedValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('currency_trades', function (Blueprint $table) {
            $table->dropColumn('payment_method_fee_value');        
            $table->dropColumn('amount_fee_value');        
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
