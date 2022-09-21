<?php

namespace App\Http\Controllers;

use App\Mail\ConversaoRealizada;
use App\Services\AwesomeCotacaoAPI;
use App\Services\ConversaoService;
use App\Services\CotacaoAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConversaoController extends Controller
{
    /**
     * @var ConversaoService
     */
    private $conversao;
    /**
     * @var CotacaoAPI
     */
    private $cotacao;

    public function __construct(ConversaoService $conversao, CotacaoAPI $cotacao)
    {
        $this->conversao = $conversao;
        $this->cotacao = $cotacao;
    }

    public function index()
    {
        return view('conversao.index');
    }

    public function calcula(Request $request)
    {

        $calculo = $this->conversao->calcula($request->moeda_origem, $request->moeda_destino, $request->valor_conversao, $request->forma_pagamento);

        if (!$calculo) {
            return redirect()->back();
        }

        Mail::to($request->user())->queue(new ConversaoRealizada($calculo));

        return view('conversao.show', compact('calculo'));

    }
}
