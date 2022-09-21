<?php

namespace App\Http\Controllers;

use App\Models\Conversao;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function index()
    {
        $conversoes = Conversao::orderBy('id','desc')->paginate();

        return view('historicos.index', compact('conversoes'));
    }
}
