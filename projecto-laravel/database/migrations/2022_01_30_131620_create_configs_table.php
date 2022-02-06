<?php

use App\Models\Config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {

            $table->id();

            /**
             * PaymentMethods - currently > CreditCart:7.63% && Ticket:1.45%
             *
             * is necessary add Rate to payment method...
             *
             * example to store: "credit-card:7.63,ticket:1.45"
             *
             * if to need add another payment method [example: debit-card], override this to: "credit-card:1.5,ticket:2.3,debit-card:1" {
             *      in this example...
             *      > credit-card has rate of 1.5%
             *      > ticket has rate of 2.3%
             *      > debit-card has rate of 1%
             * }
             */
            $table->string('payment_methods')->default('credit-card:7.63,ticket:1.45');


            /**
             * Fee By Level and Fee Limit By Level
             *
             * If value convertion >= fee_limit_level_one, apply fee of the next level
             *
             * Example:
             * > fee_limit_level_one=3000
             * > fee_level_one=2
             * > fee_limit_level_two=null << not implemented. Currently value is fixed NULL
             * > fee_level_two=1
             *
             * if value convertion < fee_limit_level_one:3000 then fee percent to apply is fee_level_one:2%
             *
             * else, apply fee_level_two:1%
             *
             * pratic example:
             * > convertion == 3000: add 1% of fee
             * > convertion == 3500: add 1% of fee
             * > convertion == 2500: add 2% of fee
             */


            $table->float('fee_level_one')->default(2);
            $table->float('fee_limit_level_one')->default(3000);

            $table->float('fee_level_two')->default(1);// fee to overflow fee_limit_level_{previous}
            $table->float('fee_limit_level_two')->nullable();// Not implement... It's to after

            /**
             * Active Currency - Enable Coins
             *
             * is necessary add enabled coins...
             *
             * example to store: "USD,EUR,BTC"
             *
             * All convertions has origin from BRL coin
             *
             * Currently is possible with api, convertion in 3 currencies: Dollar, Euro and BitCoin
             *
             */
            $table->string('active_currency')->default('USD,EUR,BTC');

            /**
             * Minimum value to accept a coin convertion
             */
            $table->float('min_value_convertion')->default(1000);

            /**
             * Maximum value to accept a coin convertion
             */
            $table->float('max_value_convertion')->default(100000);

            /**
             * Api convertion URI
             */
            $table->string('api_uri', 255)->default('https://economia.awesomeapi.com.br/last/');

            $table->timestamps();

            $table->softDeletes();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
