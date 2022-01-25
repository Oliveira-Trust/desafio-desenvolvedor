<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table): void {
            $table->id();
            $table->string('currency');
            $table->float('value');
            $table->string('methodPayment');
            $table->float('priceCurrency');
            $table->float('finalValue');
            $table->float('methodPaymentFee');
            $table->float('conversionFee');
            $table->float('discountedValue');
            $table->unsignedBigInteger('userId');
            $table->timestamp('createdAt')->default(now());
            $table->timestamp('updatedAt')->default(now());

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
}
