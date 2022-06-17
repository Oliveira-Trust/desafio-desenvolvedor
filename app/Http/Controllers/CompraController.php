<?php

namespace App\Http\Controllers;

use App\Services\CompraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
    private $compraService;
    public function __construct() {
        $this->compraService = new CompraService();
    }

    public function comprarMoeda(Request $request){
        //todo: separar validação em outra classe
        $validated = Validator::make($request->all(),[
            'valorInicial'  => 'required|numeric|gt:1000',
            'tipoPagamento' => 'required|integer',
            'moedaDestino'  => 'required|string',
            'moedaInicial'  => 'string'
        ], [
            'valorInicial.gt'       => 'O valor deve ser maior que 1000',
            'valorInicial.numerics' => 'Valor inválido',
            'required'              => ':attribute é obrigatório.',
            'integer'               => ':attribute deve ser um número inteiro.',
            'numeric'               => ':attribute deve ser um número.',
        ]);

        if($validated->fails()){
            return response()->json($validated->errors(), 422);
        }

        $moedaDestino = $request->moedaDestino;
        $moedaInicial = $request->moedaInicial;
        $tipoPagamento = $request->tipoPagamento;
        $valorInicial = $request->valorInicial;

        return $this->compraService->comprarMoeda($moedaDestino, $moedaInicial, $tipoPagamento, $valorInicial);
    }
}
