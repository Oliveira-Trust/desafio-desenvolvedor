<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Email extends Controller
{
    public function enviar(){

        $taxaPg = $_POST['resultTaxaPg'];
        $formaPg = $_POST['resultPg'];
        $taxaConversao = $_POST['resultTaxaCv'];
        $descontoValorConversao = $_POST['resultDescontos'];
        $valorConvertido = $_POST['resultValorFinal'];
        $moedaDestino = $_POST['resultDestino'];
        $valor = $_POST['resultValor'];
        $valorMoeda = $_POST['resultValorDestino'];
        $email = $_POST['email'];
        
        $dados = [
            'taxaPg'             => $taxaPg,
            'formaPg'            => $formaPg,
            'taxaConversao'      => $taxaConversao,
            'valorComDesconto'   => $descontoValorConversao,
            'valorConvertido'    => $valorConvertido,
            'moedaDestino'       => $moedaDestino,
            'valorParaConversao' => $valor,
            'valorMoeda'         => $valorMoeda  
        ];

        Mail::to($email)->send(new SendMail($dados));

        return response()->json(['success'=>true]);
        
    }
    
}
