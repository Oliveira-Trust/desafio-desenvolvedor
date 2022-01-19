<?php

namespace app\Repositories;

use App\Services\AwesomeApiService;
use App\Repositories\QuotationsRepository;
use App\Jobs\SendQuotationJob;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ExchangeRepository 
{

    /**
     * @var private  $awesomeApiService Service
     * 
     */
    private $awesomeApiService;

        /**
     * @var private  $quotationsRepository Repository
     * 
     */
    private $quotationsRepository;


    public function __construct()
    {
        $this->awesomeApiService = new AwesomeApiService();
        $this->quotationsRepository = new QuotationsRepository();
    }
    /**
     * Método Responsável por retornar cotação da moeda padrão (REAL - BRL )
     * na moeda destino.
     * 
     * @param array $data
     * 
     * @return array $response 
     */


     public function makeExchange($data)
     {
        try {

            if(validValue($data['amount'])){
                $exchangeRate = rate($data['amount']);
                $paymentTypeRate = paymentRate($data['paymentType']);
                
                $conversionRate = $data['amount'] * $exchangeRate;
                $paymentRate = $data['amount'] * $paymentTypeRate;
    
                $netAmount = $data['amount'] - ($conversionRate + $paymentRate); 
    
                $todayQuotation =  $this->awesomeApiService->getQuotation($data['coin']);
                
                $convertedAmount  = $netAmount / floatval($todayQuotation);

                
                $quotation = array ('target_coin' => 'BRL',
                                   'source_coin' => $data['coin'],
                                   'conversion_amount'=>round(floatval($data['amount']),2),
                                   'payment_type' => $data['paymentType'],
                                   'source_coin_value'=>round(floatval($todayQuotation),2),
                                   'buy_amount'=>round($convertedAmount,2),
                                   'rate_payment'=>round($paymentRate,2),
                                   'conversion_rate'=>round($conversionRate,2),
                                   'net_amount'=>round($netAmount,2));
                
                    $this->quotationsRepository->store($quotation);
                
                SendQuotationJob::dispatch($quotation, Auth::user()->email, Auth::user()->name);
    
                $response =  array('data'=>$quotation, 'httpCode'=>200);
                
             } else {
                 $response = ['message' => 'Faixa inválida para cotação', 'httpCode'=>405];
             }
        } catch (Exception $e) {
            $response = ['message' => 'Ocorreu uma falha no processamento, Contate o administrador do sistema.', 'httpCode'=>400];
            Log::error("Ocorreu uma falha no processamento da cotação. Error : " . $e->getMessage());
        }
        return $response;
     }

}