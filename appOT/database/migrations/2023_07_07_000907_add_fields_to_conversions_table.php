<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('conversions', function (Blueprint $table) {
            $table->float('conversion_fee');
            $table->float('payment_tax');
            $table->float('total_amount_origin_currency');
            $table->float('total_amount_destination_currency');

        });
    }

    public function down()
    {
        Schema::table('conversions', function (Blueprint $table) {
            $table->dropColumn('conversion_fee');
            $table->dropColumn('payment_tax');
            $table->dropColumn('total_amount_origin_currency');
            $table->dropColumn('total_amount_destination_currency');
        });
    }
};
