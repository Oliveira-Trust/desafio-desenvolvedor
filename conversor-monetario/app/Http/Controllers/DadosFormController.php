<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DadosFormController extends Controller
{
    public function dados_form(){
        return view ('conversor/home');
    }
    
    public function valida(Request $request){
        
        $data= $request->all();

        dd($data);

        //return;
    }
    
}