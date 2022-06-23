<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConverteFormRequest;
use App\Services\CompraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
    private $compraService;
    public function __construct() {
        $this->compraService = new CompraService();
    }

    public function montaTela()
    {
        $dados = $this->compraService->montaTela();

        return view('conversao/conversao-header-view', $dados);
    }

    public function converterMoeda(ConverteFormRequest $request)
    {
        $moedaDestino = $request->moedaDestino;
        $moedaInicial = $request->moedaInicial;
        $tipoPagamento = $request->tipoPagamento;
        $valorInicial = $request->valorInicial;

        $dados = $this->compraService->converterMoeda($moedaDestino, $moedaInicial, $tipoPagamento, $valorInicial);

        $dadosTratados = $this->compraService->trataDadosParaView($dados);

        return view('conversao/conversao-body-view', $dadosTratados);
    }
}
