<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvertedValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('converted_values', function (Blueprint $table) {
            $table->id();
            $table->decimal('origin_value', 10,2);
            $table->enum('origin_currency', ['BRL'])->default('BRL');
            $table->decimal('converted_value', 10,2);
            $table->decimal('tax_conversion', 10,2);
            $table->decimal('tax_payment_method', 10,2);
            $table->decimal('tax_currency', 10,2);
            $table->decimal('updated_value', 10,2);
            $table->enum('converted_currency', ['USD', 'EUR']);
            $table->enum('payment_method', ['CREDIT_CARD', 'BANK_SLIP']);
            $table->string('tenant_id')->constrained('tenants');
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
        Schema::dropIfExists('converted_values');
    }
}
