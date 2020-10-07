<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::table('product_sales', function (Blueprint $table) {
            $table->foreignId('product_id')
                    ->constrained('products')
                    ->onUpdate('no action')
                    ->onDelete('no action');
        });

        Schema::table('product_sales', function (Blueprint $table) {
            $table->foreignId('sale_id')
                    ->constrained('sales')
                    ->onUpdate('no action')
                    ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_sales', function (Blueprint $table) {
            $table->dropForeign(['sale_id']);
        });

        Schema::table('product_sales', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('product_sales');
    }
}
