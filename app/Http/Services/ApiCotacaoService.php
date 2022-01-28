<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class ApiCotacaoService
{
    protected $urlHostApi;
    protected $urlPathApi;

    public function __construct(){
        
        $this->urlHostApi = env('AWESOMEAPI_URL_HOST');
        $this->urlPathApi = env('AWESOMEAPI_URL_PATH');

    }
   
    public function buscarCotacao(String $strParametroMoeda){
        
        try {
            $client = new Client([
                'base_uri' => $this->urlHostApi,
                'timeout'  => 10,
            ]);
            
            $response = $client->request('GET', $this->urlPathApi.$strParametroMoeda);

            if($response->getStatusCode() !== 200){
                return response()->json(['Erro ao processar a solicitação',$response->getStatusCode()]);
            }
            return json_decode($response->getBody(),true);

        } catch (\Throwable $th) {
            
            return response()->json(["Erro ao processar a solicitação.\n".$th->getMessage(), 404]);
        }
        
    }

    
}
