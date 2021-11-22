<?php

namespace App\Http\Controllers;

use App\Models\CotacaoModel;
use Illuminate\Http\Request;
use App\Models\FormaPagamentoModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Factory\FormaPagamentoFactory;
use App\Http\Requests\CreateCotacaoRequest;

class CotacaoController extends Controller
{
    function __construct(CotacaoModel $cotacao)
    {
        $this->model = $cotacao;
    }

    public function index()
    {
        return view('cotacao/index')->with('cotacoes', $this->model->where(["id_user" => Auth::user()->id])->get());
    }

    public function show()
    {
        $moedas = Http::get('https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,BTC-BRL');
        return view('cotacao/create')
        ->with('moeads', json_decode($moedas))
        ->with('formas_pagamento', FormaPagamentoModel::where(['id_user' => Auth::user()->id])->get());
    }

    public function create(CreateCotacaoRequest $request)
    {
        $formaPagamentoFactory              = new FormaPagamentoFactory();
        $this->model->moeda_destino         = $request->moeda_destino;
        $this->model->moeda_origem          = $request->BRL;
        $this->model->taxa_conversao        = $request->taxa_conversao <= 3000 ?
        $request->taxa_conversao +=$request->taxa_conversao*0.02: $request->taxa_conversao +=$request->taxa_conversao*0.01;
        $this->model->forma_pagamento       = $request->forma_pagamento;
        $this->model->taxa_forma_pagamento  = $formaPagamentoFactory->formaPagamento($request->forma_pagamento)->implementaRegras($request->valor_liquido);
        $this->model->valor_liquido         = $request->valor_liquido;
        $this->model->valor_bruto           = $request->valor_bruto;
        $this->model->id_user = Auth::user()->id;
        $this->model->save();

        session()->flash('msg', 'A cotacao foi cadastrada com sucesso!');

        return redirect()->route('index.cotacao');
    }

    public function delete(Request $request)
    {
        $this->model->where(['id_cotacao' => $request->id])->delete();
        return true;
    }
}
