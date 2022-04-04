<?php

use App\Models\PaymentType;
use App\Models\User;
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
        Schema::create('currency_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('origin_currency', '3');
            $table->float('origin_currency_value', 8, 2);
            $table->unsignedBigInteger('destination_currency_id');
            $table->foreign('destination_currency_id')->references('id')->on('currencies');
            $table->float('destination_currency_price', 10, 2);
            $table->float('payment_fee', 5, 2)->nullable();
            $table->float('converted_currency_value', 10, 2);
            $table->float('payment_fee_value', 10, 2)->nullable();
            $table->foreignIdFor(PaymentType::class);
            $table->foreignIdFor(User::class);
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
        Schema::dropIfExists('currency_purchases');
    }
};
