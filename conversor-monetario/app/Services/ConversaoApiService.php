<?php

namespace App\Services;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConversaoApiService 
{
    public function getLegenda()
    {  
        $traducaoMoeda = Http::get('https://economia.awesomeapi.com.br/json/available/uniq');
        $traducaoMoeda = (array)json_decode($traducaoMoeda->body());
        
        unset($traducaoMoeda['BRL'], $traducaoMoeda['BRLT']);

        return $traducaoMoeda; 
    }
}