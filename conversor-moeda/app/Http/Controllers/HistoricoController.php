<?php

namespace App\Http\Controllers;

use App\Models\HistoricoConversao;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function index()
    {
        $historicos = HistoricoConversao::all();
        return view('historico.index', compact('historicos'));
    }
}
