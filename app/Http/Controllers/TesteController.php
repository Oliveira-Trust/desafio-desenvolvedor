<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ExchangeRequest;
use App\Services\AwesomeApiService;
use Illuminate\Support\Facades\Auth;

class TesteController extends Controller
{

    private $awesomeApiService;


    public function __construct(AwesomeApiService $awesomeApiService){
        $this->awesomeApiService = $awesomeApiService;
    }

    public function index()
    {
        dd(Auth::user()->name);
        
       // $request = Http::get('https://economia.awesomeapi.com.br/json/last/'.$coin.'-BRL');
       // $response = json_decode($request)->USDBRL->bid;
        
        $data = array ('amount'=>5000.00, 'paymentType'=>'BankSlips', 'coin'=>'USD');
        
        if(validValue($data['amount'])){
            $exchangeRate = rate($data['amount']);
            $paymentTypeRate = paymentRate($data['paymentType']);
            
            $conversionRate = $data['amount'] * $exchangeRate;
            $paymentRate = $data['amount'] * $paymentTypeRate;

            $netAmount = $data['amount'] - ($conversionRate + $paymentRate); 

            $todayQuotation =  $this->awesomeApiService->getQuotation($data['coin']);
            
            $convertedAmount  = $netAmount / floatval($todayQuotation);

            $response = array ('target_coin' => 'BRL',
                               'source_coin' => $data['coin'],
                               'conversion_amount'=>$data['amount'],
                               'payment_type' => $data['paymentType'],
                               'source_coin_value'=>round(floatval($todayQuotation),2),
                               'buy_amount'=>round($convertedAmount,2),
                               'rate_payment'=>round($paymentRate,2),
                               'conversion_rate'=>round($conversionRate,2),
                               'net_amount'=>round($netAmount,2));

            dd($response);
         } else {
             dd(false);
         }

    }
  

}
