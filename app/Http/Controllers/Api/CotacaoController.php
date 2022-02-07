<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCotacaoRequest;
use App\Http\Requests\UpdateCotacaoRequest;
use App\Http\Resources\CotacaoResource;
use App\Services\GetCotacaoService;
use App\Models\Cotacao;
use Exception;

class CotacaoController extends Controller
{
    public function cotacao()
    {
        if (request()->isMethod('GET')) {
            $cotacao = new GetCotacaoService();
            return response()->json(['cotacao' => $cotacao->getCotacao()]);
        }
        $moedaOrigem = "BRL"; #baseado nas regras de negocio, a origem sempre sera real
        $moedaDestino = request()->input('moedaDestino');
        $valorConversao = request()->input('valorConversao');
        $formaPagamento = request()->input('formaPagamento');
        try {
            $cotacao = new GetCotacaoService();
            return $cotacao->cotacao($moedaOrigem, $moedaDestino, $valorConversao, $formaPagamento);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
