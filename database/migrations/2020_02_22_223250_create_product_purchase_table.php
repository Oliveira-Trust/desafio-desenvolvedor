<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_purchase', function (Blueprint $table) {
            $table->bigInteger('purchase_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->decimal('unitary_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->integer('qtd')->unsigned();
            $table->timestamps();
        });

        Schema::table('product_purchase', function (Blueprint $table) {
            $table->primary(['purchase_id', 'product_id']);
            $table->foreign('purchase_id')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_purchase', function (Blueprint $table) {
            $table->dropForeign('product_purchase_purchase_id_foreign');
            $table->dropForeign('product_purchase_product_id_foreign');
        });
        Schema::dropIfExists('product_purchase');
    }
}
