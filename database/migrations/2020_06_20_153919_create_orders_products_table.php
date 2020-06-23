<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->integer('qnt');
            $table->decimal('price', 10, 2);
            $table->string('order_id');
            $table->string('product_id');
            $table->timestamps();
        });
        Schema::table('orders_products', function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('uuid')
                ->on('purchase_orders');
            $table->foreign('product_id')
                ->references('uuid')
                ->on('products');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_products', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['product_id']);
        });
        Schema::dropIfExists('orders_products');
    }
}
