<?php

use App\Models\User;
use App\Models\PaymentMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyTrades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_trades', function (Blueprint $table) {
            $table->id();
            $table->double('amount_brl', 8, 2);
            $table->double('amount', 8, 2);
            $table->string('currency');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(PaymentMethod::class);
            $table->double('payment_method_fee', 8, 2);
            $table->double('payment_method_fee_value', 8, 2);
            $table->double('amount_fee', 8, 2);
            $table->double('amount_fee_value', 8, 2);
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
        Schema::dropIfExists('currency_trades');
    }
}
