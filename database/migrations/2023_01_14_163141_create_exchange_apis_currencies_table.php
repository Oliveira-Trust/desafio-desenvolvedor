<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_apis_currencies', function (Blueprint $table) {
            $table->id();
            $table->string("exchange_api_slug", "30");
            $table->unsignedBigInteger("currency_id");
            $table->string("code", "15");
            $table->timestamps();
            $table->foreign("currency_id")->references("id")->on("currencies");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_apis_currencies');
    }
};
