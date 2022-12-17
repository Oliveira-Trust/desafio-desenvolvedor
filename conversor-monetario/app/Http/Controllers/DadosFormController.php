<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConversao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DadosFormController extends Controller
{
    public function dadosForm(){
        return view ('conversor/home');
    }
    
    public function valida(StoreConversao $request){
        
        $dado= $request->all();

        //dd($dado);

        return $dado;
    }
    
}