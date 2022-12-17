<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DadosFormController;
use Illuminate\Support\Facades\Http;

class ConsomeApiController extends Controller
{
    public function pegaLegenda(){
        $traducaoMoeda = Http::get('https://economia.awesomeapi.com.br/json/available/uniq');
        $traducaoMoeda = (array)json_decode($traducaoMoeda->body());
        
        unset($traducaoMoeda['BRL'], $traducaoMoeda['BRLT']);

        return view('/conversor/home', ['traducaoMoeda' => $traducaoMoeda]); 
    }

    public function pegaDadosCotacao(){
        
    }
}
