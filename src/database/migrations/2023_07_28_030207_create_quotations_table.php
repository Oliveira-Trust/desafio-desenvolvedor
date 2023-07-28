<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('currency_origin');
            $table->string('currency_destination');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->decimal('payment_tax', 5, 2);
            $table->decimal('conversion_tax', 5, 2);
            $table->decimal('amount_with_conversion_tax', 10, 2);
            $table->decimal('conversion_rate', 10, 5);
            $table->decimal('foreign_amount', 15, 10);
            $table->timestamps();

            // Definir chave estrangeira para o usuário
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
    }
}
