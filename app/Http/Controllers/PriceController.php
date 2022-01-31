<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Models\Price;
use App\Http\Controllers\SettingController;

class PriceController extends Controller
{
    public function index()
    {
        return view('price.index');
    }

    public function getAll()
    {
        $prices = Price::limit(5)->orderBy('created_at', 'DESC')->get();

        return $prices;
    }


    public function create(Request $request)
    {

        $prices = [];

        //Conversão currency_from para currency_to
        $currency_from = $request->post("currency_from") ?? null;
        $currency_to = $request->post("currency_to") ?? null;

        //Critério de aceitação:
        if($request->post("currency_from") == "BRL" && $request->post("total") > 100 && $request->post("total") < 100000)
        {

            $aweSomeApi = new AweSomeApi();
            $getConversionCurrency = $aweSomeApi->conversionCurrency($currency_from, $currency_to);

            foreach ($getConversionCurrency as $currency) {

                $price['currency_from']  = $currency["code"];
                $price['currency_to']    = $currency["codein"];
                $price['total']          = $request->post("total");
                $price['payment_method'] = $request->post("payment_method");

                $price['weight_from'] = 1;
                $price['weight_to']   = (float) $currency['bid'] ?? 0;

                //Taxa de pagamento
                $price['payment_rate'] = $this->getPaymentRate($price['total'], $price['payment_method']);

                //Taxa de conversão
                $price['conversion_rate'] = $this->getConversionRate($price['total']);

                //Valor comprado em "Moeda de destino"
                $price['buy_to_rate'] = $this->getConvertCurrency($price['total'] - $price['payment_rate'] - $price['conversion_rate'], $price['weight_to']);

                //Valor utilizado para conversão descontando as taxas
                $price['total_rate'] = $price['total'] - ($price['payment_rate'] + $price['conversion_rate']);

                array_push($prices, Price::create($price));
            }
        }

        unset($price);

        //Remover comentário para testar rotina de envio de e-mail
        // if(count($prices) > 0){
        //     \Mail::to( \Auth::user()->email)->send(new \App\Mail\PriceMail($prices));
        // }

        return Response::json($prices);
    }

    public function getPaymentRate($total, $payment_method)
    {
        $setting = new SettingController();

        $payment_rate = $setting->getAll();

        return $total * ($payment_rate[$payment_method]) / 100 ?? 0;
    }

    public function getConversionRate($total)
    {
        //2% abaixo de 3000 ou 1% acima de 3000
        //o modelo de tabela setting também permitiria colocar esta conf
        $conversion_rate = ($total > 3000) ? 0.01 : 0.02;
        return $total * $conversion_rate;
    }

    public function getConvertCurrency($total, $weight)
    {
        return $total * $weight;
    }
}
