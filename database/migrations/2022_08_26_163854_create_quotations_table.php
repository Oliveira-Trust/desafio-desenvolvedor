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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('source_currency_acronym');
            $table->string('source_currency_symbol');
            $table->string('target_currency_acronym');
            $table->string('target_currency_symbol');
            $table->float('target_currency_quote');
            $table->float('source_amount');
            $table->float('payment_method_fee_amount');
            $table->float('payment_method_fee_percentage', 8, 4);
            $table->float('conversion_fee_amount');
            $table->float('conversion_fee_percentage', 8, 4);
            $table->float('source_taxed_amount');
            $table->float('target_amount');
            $table->string('payment_method');
            $table->enum('payment_status', ['Em aberto', 'Pago', 'Cancelado'])->default('Em aberto');
            $table->foreignIdFor(\App\Models\User::class);
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
    }
};
