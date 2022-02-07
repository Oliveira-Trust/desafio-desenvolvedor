<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoinConvertionRequest;
use App\Models\CoinConvertion;
use App\Models\Config;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoinConvertionControllerApi extends Controller
{
    /**
     * Make currency convertion
     */
    public function convertCoin(CoinConvertionRequest $request)
    {
        $config = Config::findOrFail(env('CONFIG_ID', 1));

        $coinConvertion = CoinConvertion::create([
            'currency_origin'                   => env('DEFAULT_ORIGIN_CONVERTION_CURRENCY', 'BRL'),
            'currency_destin'                   => $request->currency,
            'conversion_value'                  => $request->convertion_value,
            'payment_method'                    => $request->payment_method,
            'config_id'                         => $config->id,
            'user_id'                           => auth()->user()->id,
        ]);

        $current_quote_origin = $this->getCurrentQuote($coinConvertion);

        $coinConvertion = $this->getTotalConvertionService($coinConvertion, $current_quote_origin);

        // Result Set
        return [

            trans('coin_convertion.success.array.currency_origin') . $coinConvertion->currency_origin,

            trans('coin_convertion.success.array.currency_destin') . $coinConvertion->currency_destin,

            trans('coin_convertion.success.array.conversion_value') . number_format($coinConvertion->conversion_value, 2, ',', '.'),

            trans('coin_convertion.success.array.payment_method') . trans('coin_convertion.success.array.payment_method.' . strtolower($coinConvertion->payment_method)),

            trans('coin_convertion.success.array.current_quote_destin') . number_format($coinConvertion->current_quote_destin, 2, ',', '.'),

            trans('coin_convertion.success.array.purchased_total') . number_format($coinConvertion->purchased_total, 2, ',', '.'),

            trans('coin_convertion.success.array.payment_fee') . number_format($coinConvertion->payment_fee, 2, ',', '.'),

            trans('coin_convertion.success.array.convertion_fee') . number_format($coinConvertion->convertion_fee, 2, ',', '.'),

            trans('coin_convertion.success.array.used_value_currency_conversion') . number_format($coinConvertion->used_value_currency_conversion, 2, ',', '.'),

        ];
    }

    private function getCurrentQuote(CoinConvertion $coinConvertion)
    {
        try {

            $client = new \GuzzleHttp\Client;
            // dd($coinConvertion->config, $coinConvertion);
            $res = $client->get(
                $coinConvertion->config->api_uri .
                $coinConvertion->currency_destin . '-' . $coinConvertion->currency_origin
            );

            // getting first resultset on array body
            foreach(json_decode($res->getBody()->getContents()) as $quote) {
                return $quote->ask;
            }

        } catch ( \Exception $e ) {
            CoinConvertion::find($coinConvertion->id)->update(['status' => 'ERROR']);
            throw $e; // ....thoughtful....
        }

    }

    /**
     * returns coinConvertion with all values configured:
     */
    private function getTotalConvertionService(CoinConvertion $coinConvertion, float $currencyQuote)
    {
        try { // has error possibility on division by zero

            $originalTotal = $coinConvertion->conversion_value;

            // applying rate according to conversion value
            if($originalTotal < $coinConvertion->config->fee_limit_level_one) {
                $convertionFee = $coinConvertion->config->fee_level_one;
            } else {
                // two possiblities
                $convertionFee = $coinConvertion->config->fee_level_two;
            }

            if(!($convertionFee > 0)) {// semantic to better performance
                throw new Error(trans('coin_convertion.convertionFeeError'));
            }

            $paymentFee = $this->getPaymentFee($coinConvertion);
            if(!$paymentFee) {
                throw new Error(trans('coin_convertion.paymentFeeError'));
            }
            // 'current_quote_destin'              => ,
            // 'purchased_total'                   => ,
            // 'used_value_currency_conversion'    => ,

            $coinConvertion->convertion_fee = $originalTotal * $convertionFee / 100;
            $coinConvertion->payment_fee = $originalTotal * $paymentFee / 100;


            $total = $originalTotal;
            $total -= $coinConvertion->convertion_fee ;
            $total -= $coinConvertion->payment_fee;

            $coinConvertion->used_value_currency_conversion = $total;
            $coinConvertion->purchased_total = $total / $currencyQuote;
            $coinConvertion->current_quote_destin = $currencyQuote;
            $coinConvertion->status = 'SUCCESS';

            $coinConvertion->save();

        } catch ( \Exception $e ) {
            CoinConvertion::find($coinConvertion->id)->update(['status' => 'ERROR']);
            throw $e; // ....thoughtful....
        }

        return $coinConvertion;

    }

    private function getPaymentFee(CoinConvertion $coinConvertion)
    {

        /**
         * PaymentMethods - currently > CreditCart:7.63% && Ticket:1.45%
         *
         * is necessary add Rate to payment method...
         *
         * example to store: "credit-card:7.63,ticket:1.45"
         *
         * if to need add another payment method [example: debit-card], override this to: "credit-card:1.5,ticket:2.3,debit-card:1" {
         *      in this example...
         *      > credit-card has fee of 1.5%
         *      > ticket has fee of 2.3%
         *      > debit-card has fee of 1%
         * }
         *
         * paymentMethods == 'x:1,y:2,z:3'
         *
         * need getting an string configured: 'x,y,z'
         *
         * ...
         */

        $config = $coinConvertion->config;

        // Get separated array separated by ",": 'x:1,y:2,z:3' == ['x:1', 'y:2', 'z:3']
        $paymentMethodsArray = explode(',', $config->payment_methods);

        // Get fee value in key $coinConvertion-> ":": ['x:1', 'y:2', 'z:3'] => first loop => 'x:1' == ['x', '1'] => getting 'x'
        foreach($paymentMethodsArray as $pma) {
            $paymentMethod = explode(':', $pma) ?? null;

            if($paymentMethod && strtolower($paymentMethod[0]) == strtolower($coinConvertion->payment_method)) {
                return $paymentMethod[1];
            }
        }

        return false;

    }
}
