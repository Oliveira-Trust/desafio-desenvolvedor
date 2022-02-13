<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyConversionsTable extends Migration
{
    public function up(): void
    {
        Schema::create(
            'currency_conversions',
            function (Blueprint $table): void {
                $table->bigIncrements('id');
                $table->string('origin_currency', 10)->default('BRL')->nullable();
                $table->string('destiny_currency', 10);
                $table->decimal('value_currency', 8, 2);
                $table->string('form_payment', 15);
                $table->decimal('value_destiny_currency', 8, 2);
                $table->decimal('payment_rate', 8, 2);
                $table->decimal('conversion_rate', 8, 2);
                $table->decimal('value_acquired_in_the_conversation', 8, 2);
                $table->decimal('value_used_for_conversion', 8, 2);
                $table->unsignedBigInteger('user_id')->nullable()->default(null);
                $table->foreign('user_id')->references('id')->on('users');
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    public function down(): void
    {
        if ($this->hasCurrencyConversions()) {
            Schema::table(
                'currency_conversions',
                function (Blueprint $table): void {
                    $table->dropForeign(['user_id']);
                    $table->dropColumn('user_id');
                }
            );
        }

        Schema::dropIfExists('currency_conversions');
    }

    protected function hasCurrencyConversions(): bool
    {
        return Schema::hasTable('currency_conversions');
    }
}
