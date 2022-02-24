<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Moeda;
use App\Models\Historico;
use App\Mail\CotacaoEmail;
use App\Models\FormasPagamento;
use App\Http\Requests\StoreHistoricoRequest;

class HistoricoController extends Controller
{
    private $taxa;

    public function __construct(TaxasController $taxa)
    {
        $this->taxa = $taxa;
        $this->middleware('auth');
    }

    /**
     * Listagem paginada de historico realizados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = Historico::paginate(10);

        return view('historico.index', compact('dados'));
    }

    /**
     * Tela para criação de nova conversão de moedas
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $moedas = Moeda::all();
        $formas = FormasPagamento::all();

        return view('historico.novo', compact('moedas', 'formas'));
    }

    /**
     * gravando dados de conversão de moedas
     *
     * @param  \App\Http\Requests\StoreHistoricoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CotacaoApi $cotar, StoreHistoricoRequest $request)
    {
        $resultado = $this->taxa->toConverter($cotar, $request);

        $historico = new Historico;

        $id = $historico->create($resultado)->id;

        //fazer envio de e-mail
        $this->enviarEmail($id);

        return redirect()->route('conversao.show', ['id' => $id])->with('status', 'Conversão Realizada com Sucesso!');
    }

    /**
     * Tela para exibir conversão detalhada
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historico = Historico::where('user_id', 1)->findOrFail($id);

        return view('historico.show', compact('historico'));
    }

    private function enviarEmail(int $id)
    {
        $dados = Historico::find($id);

        Mail::to(
            auth()->user()->email,
            auth()->user()->name
            )->send(new CotacaoEmail([
            'to'                => auth()->user()->email,
            'valor_conversao'   => $dados['valor_conversao'],
            'taxa_conversao'    => $dados['taxa_conversao'],
            'taxa_pagamento'    => $dados['taxa_pagamento'],
            'moeda_destino'     => $dados['moeda_destino'],
            'valor_comprado'    => $dados['valor_comprado'],
            'total_descontato'  => $dados['total_descontato'],
            'valor_moeda_destino' => $dados['valor_moeda_destino']
        ]));
    }

    /**
     * Enviar novamente e-mail de cotação
     *
     * @param  \App\Http\Requests\StoreHistoricoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function EnviarNovoEmail(int $id)
    {
        $this->enviarEmail($id);

        return redirect()->back()->with('status', 'E-mail enviado com sucesso!');
    }
}
