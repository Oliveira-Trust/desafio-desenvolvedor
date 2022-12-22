<?php

namespace App\Services;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConversaoApiService 
{
    private $calculaService;
    
    public function getLegenda()
    {  
        $traducaoMoeda = Http::get(env('BASE_URL') . 'json/available/uniq');
        $traducaoMoeda = (array)json_decode($traducaoMoeda->body());
        
        unset($traducaoMoeda['BRL'], $traducaoMoeda['BRLT']);

        return $traducaoMoeda; 
    }

    public function getCotacao(string $base, string $destino){
        $cotacao = Http::get(env('BASE_URL') . 'last/' . $base . '-' . $destino);
        
        return json_decode($cotacao->body())->{$base . $destino}->bid;
    }
}