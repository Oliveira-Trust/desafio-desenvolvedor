<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DadosFormController;
use Illuminate\Support\Facades\Http;

class ConsomeApiController extends Controller
{
    public function pegaLegenda(){
        $traducaoMoeda = Http::get('https://economia.awesomeapi.com.br/json/available/uniq');
        $traducaoMoeda = json_decode($traducaoMoeda->body());
        $traducaoMoeda = (array) $traducaoMoeda;
       
        foreach($traducaoMoeda as $traducao=>$tr){
            
            if($traducao == "BRL" || $traducao == "EUR" || $traducao == "JPY" || $traducao == "USD"){
                $moedasValidas[] = $tr;
                $siglas[] = $traducao;
            }
        }

        return view('/conversor/home', 
        [
            'moedasValidas' => $moedasValidas,
            'siglas' => $siglas
        ]);
        
    }

    public function pegaDadosCotacao(){

    }
}
