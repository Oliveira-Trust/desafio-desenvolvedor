<?php

namespace App\Repositories;


use App\Models\Rate;
use Exception;
use Illuminate\Support\Facades\Log;

class RateRepository
{

    /**
     * @var private $rate Model
     */
    private $rate;


    /**
     * Método construtor 
     */
    public function __construct()
    {
        $this->rate = new Rate();
    }

    /**
     * Método reposável por recuperar os valores e taxas para painel de controles
     * 
     * @return collection $rates
     */

    public function getAll()
    {
        try {
            $rates =  $this->rate->all();
            $response  =  array('data'=>$rates, 'httpCode'=>200);

        } catch (Exception $e) {
            $response = array ('message'=> 'Ocorreu uma falha na coleta dos parâmetros de taxas e valores.', 'httpCode'=>400);
            Log::error("Ocorreu uma falha na coleta dos parâmetros de taxas e valores. Error: ". $e->getMessage());
        }

        return $response;

    }

    /**
     * Método reponsável por efetuar as alterações dos valores e taxas do painel de controle
     * 
     * @param array $data
     * 
     * @return collection $rates
     */

    public function update($data)
    {
        try {
            $updateRates = $this->rate->find($data['id']);
            $updateRates->update($data);
            $rates = $this->getAll();
            $response  =  array('data'=>$rates, 'httpCode'=>200);

        } catch (Exception $e) {
            $response = array ('message'=> 'Ocorreu uma falha na alteração dos parâmetros de taxas e valores.', 'httpCode'=>400);
            Log::error("Ocorreu uma falha na alteração dos parâmetros de taxas e valores. Error: ". $e->getMessage());
        }

        return $response;

    }


}