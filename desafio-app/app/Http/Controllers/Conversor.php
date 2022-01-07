<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Conversor extends Controller
{
    public function store($moeda, $valor, $pagamento)
    {
        // Buscando dados da api
        $url = "https://economia.awesomeapi.com.br/last/$moeda-BRL";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $dados = json_decode(curl_exec($ch));

        // Separando os dados que serão usados no cálculo
        foreach ($dados as $key) {
            $valor = $key->bid;
        }

        return response()->json(['teste'=>$valor]);
    }
}
