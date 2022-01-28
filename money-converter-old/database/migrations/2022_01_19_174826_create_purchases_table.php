<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            $table->unsignedBigInteger('payment_type_id');
            $table->foreign('payment_type_id')
                ->references('id')
                ->on('payment_types')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');

            $table->string('origin', 10);
            $table->string('destiny', 10);
            $table->float('quotation_value');
            $table->float('payment_taxe');
            $table->float('conversion_taxe');
            $table->float('request_value');
            $table->float('purchase_value');
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
        Schema::dropIfExists('purchases');
    }
}
