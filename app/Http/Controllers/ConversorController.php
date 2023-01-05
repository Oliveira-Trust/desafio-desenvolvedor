<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConversorRequest;
use App\Services\CotacaoService;

class ConversorController extends Controller
{
    public function conversor(ConversorRequest $request)
    {
        $cotacao = new CotacaoService($request->input('valor'), $request->input('moeda'), $request->input('pagamento'));
        $data = $cotacao->converterMoeda();
        return response()->json([
            'data'  =>  [
                'success'   =>  true,
                'info'  =>  $data
            ]
        ]);
    }
}
