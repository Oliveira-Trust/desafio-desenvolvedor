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
            $table->id();
            $table->integer('qnt');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
        Schema::table('orders_products', function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('id')
                ->on('purchase_orders');
            $table->foreign('product_id')
                ->references('id')
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