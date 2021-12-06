<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HistoricoCotacao as Historico;

class HistoricoCotacaoController extends Controller
{
    public function index() 
    {
        $cotacoes = new Historico;
        
        $userid = session()->get('id');

        $cotacoes = $cotacoes->with(['user'])->where('user_id', $userid)->get();

        return view('app.historico_cotacoes', ['cotacoes' => $cotacoes]);
    }

}
