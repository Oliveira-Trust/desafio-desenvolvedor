
<?php
// database/migrations/create_historical_quotes_table.php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricalQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historical_quotes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('from_currency');
            $table->string('to_currency');
            $table->decimal('amount', 10, 2);
            $table->decimal('converted_amount', 10, 2);
            $table->decimal('conversion_rate', 10, 2);
            $table->decimal('payment_fee', 10, 2);
            $table->decimal('conversion_fee', 10, 2);
            $table->string('payment_method');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historical_quotes');
    }
}
