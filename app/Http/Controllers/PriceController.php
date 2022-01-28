<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use Response;
use App\Models\Price;

class PriceController extends Controller
{
    public function index()
    {
        return view('price.index');
    }


    public function create(Request $request)
    {

        $price = [];

        $price['currency_from']  = $request->post("currency_from");
        $price['currency_to']    = $request->post("currency_to");
        $price['total']          = $request->post("total");
        $price['payment_method'] = $request->post("payment_method");

        //Valor da "Moeda de destino" usado para conversão:
        //BRL-USD
        $get = Http::get("https://economia.awesomeapi.com.br/json/last/{$price['currency_from']}-{$price['currency_to']}");
        
        if($get->status() != 200){
            return 'erro na api';
        }

        $price['weight_from'] = 1;
        $price['weight_to']   = (float) $get->json()['BRLUSD']['bid'] ?? 0;
        // $price['weight_to']   = $price['weight_from'] / $price['weight_to'];

        //Taxa de pagamento
        $price['payment_rate'] = $this->getPaymentRate($price['total'], $price['payment_method']);

        //Taxa de conversão
        $price['conversion_rate'] = $this->getConversionRate($price['total']);
        
        //Valor comprado em "Moeda de destino"
        $price['buy_to_rate'] = $this->getConvertCurrency($price['total']-$price['payment_rate']-$price['conversion_rate'], $price['weight_to']);
        
        //Valor utilizado para conversão descontando as taxas
        $price['total_rate'] = $price['total'] - ($price['payment_rate'] + $price['conversion_rate']);


        $data = $request->validate([
            'currency_from' => 'required|max:3',
            'currency_to' => 'required|max:3',
            'total' => 'required|between:1,10',
            'payment_method' => 'required'
        ]);

        $price = Price::create($price);

        return Response::json($data);

    }

    public function getPaymentRate($total, $payment_method)
    {
        //ticket = '1,45%' ou card = '7,63%'
        $payment_rate = [
            'ticket' => 0.0145, 
            'card' => 0.0763
        ];

        return $total * $payment_rate[$payment_method] ?? 0;
    }

    public function getConversionRate($total)
    {
        //2% abaixo de 3000 ou 1% acima de 3000
        $conversion_rate = ( $total > 3000 )? 0.01 : 0.02; 
        return $total * $conversion_rate;
    }

    public function getConvertCurrency($total, $weight)
    {
        return $total * $weight;
    }
}
