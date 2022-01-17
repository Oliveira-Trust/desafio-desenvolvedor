<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConversations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->string('origin_currency');
            $table->string('destination_currency');
            $table->decimal('conversion_value',12,2);
            $table->string('payment');
            $table->decimal('value_purchase_currency_destination',12,2);
            $table->decimal('payment_rate',12,2);
            $table->decimal('conversion_rate',12,2);
            $table->decimal('converted_value',12,2);
            $table->decimal('purchase_value',12,2);
            $table->integer('user_id');
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
        Schema::dropIfExists('conversations');
    }
}
