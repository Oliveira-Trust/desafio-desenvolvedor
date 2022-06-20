<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10);
            $table->string('name', 50);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('currency_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')->constrained('currencies');
            $table->decimal('price', 12, 4)->unsigned();
            $table->foreignId('user_id')->nullable()->constrained('users');//Pra saber se esse registro foi cadastrado por algum usuário
            $table->timestamps();
        });

        Schema::create('payment_types', function (Blueprint $table) {
            $table->id();
            $table->string('description', 20);
            $table->timestamps();
        });

        Schema::create('fee_types', function (Blueprint $table) {
            $table->id();
            $table->string('description', 20);
            $table->timestamps();
        });

        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fee_type_id')->constrained('fee_types');
            $table->foreignId('payment_type_id')->nullable()->constrained('payment_types');
            $table->decimal('min_amount')->unsigned();
            $table->decimal('max_amount')->unsigned();
            $table->decimal('percent')->unsigned();
            $table->decimal('fixed_value')->unsigned();
            $table->timestamps();
        });

        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('payment_type_id')->constrained('payment_types');
            $table->foreignId('currency_id')->constrained('currencies');
            $table->foreignId('currency_price_id')->constrained('currency_prices');
            $table->decimal('amount')->unsigned();
            $table->decimal('price', 12, 4)->unsigned();
            $table->json('fees');
            $table->decimal('exchanged_amount', 15)->unsigned();
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
        Schema::dropIfExists('quotations');
        Schema::dropIfExists('fees');
        Schema::dropIfExists('fee_types');
        Schema::dropIfExists('payment_types');
        Schema::dropIfExists('currency_prices');
        Schema::dropIfExists('currencies');
    }
};
