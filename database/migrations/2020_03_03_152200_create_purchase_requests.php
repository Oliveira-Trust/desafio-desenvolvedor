<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('id_client');
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade');
            
            $table->unsignedInteger('id_product');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
            
            $table->integer('quantity');
            
            $table->decimal('price_total', 10, 2);
            
            $table->tinyInteger('status')->comment('0 = Cancelado, 1 = Em Aberto, 2 = Pago');
            
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
        Schema::dropIfExists('purchase_requests');
    }
}
