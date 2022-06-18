<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalculoService;
use App\Helpers\CalculoHelper;

class CalculoController extends Controller
{
    public function __construct()
    {
        $this->ROTA_CONSULTA_PRECO = "https://economia.awesomeapi.com.br/last/";
    }


#função onde são capturadas as informações para que hajam as consultas e os calculos.
#
    public function converterValores(Request $request)
    {
        $CalculoHelper = new CalculoHelper;

        // retira pontuação e deixa a variavel pronta para operações
        $valor_real = CalculoHelper::limpar_valor($request->valor_real);

        // Validação para que não sejam possiveis conversoes de valores fora do range de valores estabelecidos.
        // É feito no back para evitar que o usuario burle o JS e passe pela validação
        $valid = CalculoHelper::validacao_valores($valor_real);
        if ($valid->error) {
            return response()->json($valid);
        }

        $moeda = $request->moeda;

        // Função que faz as consultas em APIs (Idealmente deveria ficar em um arquivo ainda mais genérico);
        $consulta_api = CalculoHelper::consultaAPI($this->ROTA_CONSULTA_PRECO . $moeda . '-BRL');
        $consulta_api = $consulta_api->json($moeda . 'BRL');

        // Pega os valores das taxas para aplicar no valor a ser convertido (Idelmente seria vindo do banco de dados ou até de um arquivo de constantes)
        $taxa_pgto = $CalculoHelper->forma_pgto($request->forma_pgto);
        $taxa_conversao = $CalculoHelper->taxa_conversao($valor_real);

        // Função que realiza os calculos;
        $ret = CalculoService::calculoConversao(floatval($valor_real), floatval($taxa_pgto), floatval($taxa_conversao), $consulta_api, $moeda, $request->user_id, $request->forma_pgto);

        return response()->json($ret);
    }

    //
}
