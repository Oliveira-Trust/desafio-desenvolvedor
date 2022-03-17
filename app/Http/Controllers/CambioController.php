<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Taxa;
use App\Models\Forma;
use App\Models\Historico;
use App\Models\Moeda;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CambioController extends Controller
{
    public function index() {
        $data = [];

        $data['moedasOrigem'] = Moeda::all();

        $data['moedasDestino'] = Moeda::select()->whereNotIn('id', [1])->get();

        $data['formas'] = Forma::all();

        return view('cambio.index', $data);
    }
    
    public function store(Request $request) {
        
        $request->validate([
            'moeda_origem_id' => 'required',
            'moeda_destino_id' => 'required',
            'forma_id' => 'required',
            'valor_conversao' => 'required|numeric|min:1000|max:100000',
        ]);
        
        $data = $request->all();

        unset($data['_token']);

        $percPagamento = Forma::where('id', $data['forma_id'])->first()->percentual;

        $taxaPagamento = $data['valor_conversao'] * $percPagamento;

        $taxas = Taxa::all();

        foreach($taxas as $taxa) {
            if($data['valor_conversao'] >= $taxa->valor_min && $data['valor_conversao'] <= $taxa->valor_max) {
                $percConversao = $taxa->percentual;
            }
        }

        $taxaConversao = $data['valor_conversao'] * $percConversao;

        $valorComprado = ($data['valor_conversao'] - $taxaPagamento - $taxaConversao) / number_format($data['valor_moeda_destino'], 2);

        $data['user_id'] = Auth::user()->id;
        
        $data['percent_taxa_pagamento'] = $percPagamento;

        $data['valor_taxa_pagamento'] = $taxaPagamento;
        
        $data['percent_taxa_conversao'] = $percConversao;

        $data['valor_taxa_conversao'] = $taxaConversao;

        $data['valor_comprado'] = $valorComprado;

        $historico = Historico::create($data);
        
        return redirect("detalhe/$historico->id");
    }

    public function list() {
        $data = [];

        $historico = new Historico;

        $data['cambios'] = $historico->getList();

        return view('cambio.lista', $data);
    }

    public function detail($id) {
        $data = [];

        $historico = new Historico;

        $data['cambio'] = $historico->getDetail($id);

        return view('cambio.detalhe', $data);
    }
}
