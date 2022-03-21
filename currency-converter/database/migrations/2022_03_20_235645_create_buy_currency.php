<?php

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
        Schema::create('buy_currency', function (Blueprint $table) {
            $table->id();
            $table->string('payment_type', '20')->description('slug of type of payment');
            $table->string('origin_currency', '5')->description('origin currency');
            $table->string('destination_currency', '5')->description('destination currency');
            $table->float('value', 8, 2)->description('buying value');
            $table->float('selling_price', 8, 2)->description('selling price')->nullable();
            $table->float('convertion_fee', 8, 2)->description('convertion fee')->nullable();
            $table->float('payment_fee', 8, 2)->description('payment fee')->nullable();
            $table->foreignIdFor(User::class)->nullable();
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
        Schema::dropIfExists('buy_currency');
    }
};
