<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinConvertionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_convertions', function (Blueprint $table) {

            $table->id();

            $table->char('origin_coin', 3);

            $table->char('destin_coin', 3);

            $table->float('current_quote_origin');

            $table->float('conversion_value');

            $table->string('form_payment');

            $table->unsignedBigInteger('config_id');

            /**
             * Danger on delete because cascade!!! But this provides integrity
             */
            $table->foreign('config_id')->references('id')->on('configs')->onDelete('cascade');

            $table->enum('status', ['SUCCESS', 'ERROR', 'FAIL']);

            $table->timestamps();

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_convertions');
    }
}
