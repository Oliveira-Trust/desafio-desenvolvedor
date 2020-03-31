<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('customer_id')->unsigned()->index()->comment('FK tbl customer');
            $table->string('customer_name', 80)->index();
            $table->string('customer_email', 150)->index();
            $table->string('customer_phone', 11)->index();
            $table->decimal('grand_total', 10, 2)->comment('valor original da compra');
            $table->decimal('final_price', 10, 2)->comment('valor final cobrado do cliente');
            $table->decimal('discount', 10, 2)->comment('desconto dado ao cliente');
            $table->enum("status", ['em_aberto','pago','cancelado'])->index()->default('em_aberto');
            $table->timestamps();

        });

        Schema::create('order_item', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('order_id')->unsigned()->index();
            $table->integer('catalog_id')->unsigned()->index()->comment('FK tbl catalog');
            $table->string('catalog_name', 80)->index();
            $table->integer('qty');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item');
        Schema::dropIfExists('order');
    }
}
