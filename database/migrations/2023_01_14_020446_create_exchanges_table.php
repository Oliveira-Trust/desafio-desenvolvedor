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
        Schema::create("exchanges", function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger("currency_id_from");
            $table->unsignedBigInteger("currency_id_to");
            $table->unsignedBigInteger("payment_method_id");
            $table->unsignedBigInteger("user_id");
            $table->decimal("amount_from",16,6);
            $table->decimal("amount_from_net",16,6);
            $table->decimal("amount_to_net",16,6);
            $table->decimal("payment_method_fee_amount",9 ,6);
            $table->decimal("exchange_fee_amount",9, 6);
            $table->decimal("bid_amount",9, 6);
            $table->foreign("currency_id_from")->references("id")->on("currencies");
            $table->foreign("currency_id_to")->references("id")->on("currencies");
            $table->foreign("payment_method_id")->references("id")->on("payment_methods");
            $table->foreign("user_id")->references("id")->on("users");
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
        Schema::dropIfExists("exchanges");
    }
};
