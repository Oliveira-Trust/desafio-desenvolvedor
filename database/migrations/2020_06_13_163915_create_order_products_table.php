<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->unsignedBigInteger("orders_id");
            $table->unsignedBigInteger("products_id");
            $table->integer("quantity");
            $table->foreign("orders_id")->references("id")->on("orders");
            $table->foreign("products_id")->references("id")->on("products");
            $table->primary(["orders_id", "products_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
