<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PaymentMethod;
use App\Models\CurrencyType;

class TradeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validaForm(Request $request){
        $regras = [
            'value' => 'required|numeric|min:1000|max:99999',
            'payment_id' => 'required',
            'currency_code' => 'required',
        ];
        $mensagens = [
            'required' => 'O campo é obrigatório',
            'value.min' => 'O valor deve ser maior que 1.000,00',
            'value.min' => 'O Valor deve ser menor que 100.000,00',
        ];
        $request->validate($regras,$mensagens);
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        unset($data['cadastrar']);

        
        unset($data['_token']);
        
        

        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paymentsMethods = PaymentMethod::all();
        $currencyTypes = CurrencyType::all();
        return view('admin.formTrade',compact('paymentsMethods','currencyTypes'));
    }


    /**
     * Realiza a negociação
     *
     * @param \Illuminate\Http\Response
     */
    public function trade(Request $request)
    {
        $data = $this->validaForm($request);
        
        $currencyValue = $this->currencyValue($data['currency_code']); // Encontra valor atual da moeda
        
        $paymentMethod = PaymentMethod::find($data['payment_id']); // Encontra o registro da forma de pagamento no banco.
        
        $paymentTaxValue = $this->paymentTax($data['value'],$paymentMethod->tax); // Calcula a taxa da forma de pagamento.
        $conversionTaxValue = $this->conversionTax($data['value']); // Calcula a taxa de conversão
        
        $resValue = $data['value'] - $paymentTaxValue - $conversionTaxValue; // Subtrai as traxas do valor informado no formulário para conversão

        $convertedValue = $resValue / $currencyValue->ask; // Resultado da conversão do valor subtraido as taxas.
        
        // grava histórico

        $res['origem'] = 'BRL';
        $res['destino'] = $data['currency_code'];
        $res['valor_para_conversao'] = number_format($data['value'],2,',','.');
        $res['forma_de_pagamento'] = $paymentMethod->name;
        $res['valor_moeda_destino'] = number_format($currencyValue->ask,2,',','.');
        $res['valor_comprado_moeda_destino'] = number_format($convertedValue,2,',','.');
        $res['taxa_pagamento'] = number_format($paymentTaxValue,2,',','.');
        $res['taxa_conversao'] = number_format($conversionTaxValue,2,',','.');
        $res['valor_conversao_descontado_taxa'] = number_format($resValue,2,',','.');
        // dd($res);
        
        return view('admin.tradeResult',compact('res'));

    }

    /**
     * Encontra o valor atual da moeda
     *
     * @param string $code
     * @return Object
     */
    public function currencyValue($code)
    {
        $url = "https://economia.awesomeapi.com.br/json/last/".$code;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = json_decode(curl_exec($ch));
        return $res->{$code.'BRL'};

    }

    /**
     * Calcula a taxa de conversão
     *
     * @param float $value
     * @return float
     */
    public function conversionTax($value)
    {
        if($value < 3000 )
            return $value * 2 / 100;
        else   
            return $value * 1 / 100;
    }

    /**
     * Calcula a taxa da forma de pagamento
     *
     * @param float $value
     * @param float $tax
     * @return float
     */
    public function paymentTax($value,$tax)
    {
        return $value * $tax / 100;
    }

    public function store()
    {


    }

}
