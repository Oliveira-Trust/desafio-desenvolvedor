<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversions_history', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');

            $table->string('origin_currency');

            $table->string('destination_currency');

            $table->decimal('value_conversation', 7, 2);

            $table->string('form_payment');

            $table->decimal('dest_currency_conv', 7, 2);

            $table->decimal('purchased_amount_in', 7, 2);

            $table->decimal('pay_rate', 7, 2);

            $table->decimal('conversion_rate', 7, 2);

            $table->decimal('amount_used_conv', 7, 2);

            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamp('deleted_at')
                ->nullable();

            $table->foreign('user_id', 'user_id_fk')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversions_history');
    }
}
