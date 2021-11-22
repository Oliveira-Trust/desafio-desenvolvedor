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
        return view('cotacao/create');
    }

    public function create(CreateCotacaoRequest $request)
    {
        $moedas = Http::get("https://economia.awesomeapi.com.br/last/$request->moeda_destino");
        $formaPagamentoFactory              = new FormaPagamentoFactory();
        $this->model->moeda_destino         = $request->moeda_destino;
        $this->model->moeda_origem          = "BRL";
        $request->valor_liquido <= 3000 ?  $this->model->taxa_conversao +=$request->valor_liquido*0.02: $this->model->taxa_conversao +=$request->valor_liquido*0.01;
        $this->model->forma_pagamento       = $request->forma_pagamento;
        $this->model->taxa_forma_pagamento  = $formaPagamentoFactory->formaPagamento($request->forma_pagamento)->implementaRegras(doubleval($request->valor_liquido));
        $this->model->valor_liquido         = doubleval($request->valor_liquido);
        $this->model->valor_bruto           = $this->model->taxa_conversao + $this->model->valor_liquido + $this->model->taxa_forma_pagamento;
        $this->model->valor_moeda_destino = $moedas[str_replace('-', '', $request->moeda_destino)]['bid'];
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
