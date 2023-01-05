<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function index()
    {
        $historico = Historico::whereUserId(auth()->user()->id)->get();

        return view('historico.index', compact('historico'));
    }
}
