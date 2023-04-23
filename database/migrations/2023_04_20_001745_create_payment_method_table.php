<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('fee_value');
            $table->timestamps();
        });

        DB::table('payment_method')->insert(
            [
                [
                    'name' => 'Invoice',
                    'fee_value' => 1.45 / 100,
                ],
                [
                    'name' => 'Credit Card',
                    'fee_value' => 7.63 / 100,
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_method');
    }
}
