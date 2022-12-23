<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ConversaoApiService 
{
    public function getLegenda() : array
    {  
        try{
            $traducaoMoeda = Http::get(env('BASE_URL') . 'json/available/uniq');
            $traducaoMoeda = (array)json_decode($traducaoMoeda->body());
            
            unset($traducaoMoeda['BRL'], $traducaoMoeda['BRLT']);
    
            return $traducaoMoeda; 
        } catch(Exception $e){
            Log::info("Erro ao obter legenda", ['Exception' => $e->getMessage()]);
            abort(500);
        }
    }

    public function getCotacao(string $base, string $destino) : float
    {
        try{
            $cotacao = Http::get(env('BASE_URL') . 'last/' . $base . '-' . $destino);
        
            return json_decode($cotacao->body())->{$base . $destino}->bid;
        }catch(Exception $e){
            Log::info("Erro ao obter cotação!", ['Exception' => $e->getMessage()]);
            abort(500);
        }
    }
}