<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Config;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('configure')->unique();
            $table->string('description');
            $table->string('val');           
            $table->timestamps();
        });

        Config::create(
            [
                'configure' => 'tax_payment.boleto',
                'description' => 'Taxa utilizada no boleto',
                'val' =>0.0145,
            ]
        );

        Config::create(
            [
                'configure' => 'tax_payment.card',
                'description' => 'Taxa utilizada no cartão',
                'val' => 0.0763,
            ]
        );

        Config::create(
            [
                'configure' => 'tax_convert.min',
                'description' => 'Taxa utilizada nos valores menores do valor base',
                'val' =>0.02,
            ]
        );

        Config::create(
            [
                'configure' => 'tax_convert.max',
                'description' => 'Taxa utilizada nos valores maiores do valor base',
                'val' =>0.01,
            ]
        );
        Config::create(
            [
                'configure' => 'tax_convert.base',
                'description' => 'valor base para taxa de conversão',
                'val' =>3000,
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
