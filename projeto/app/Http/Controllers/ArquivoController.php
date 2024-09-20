<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArquivoController extends Controller
{
    public function arquivos(): View
    {
        return view('index');
    }

    public function importar(): View
    {
        return view('importar');
    }

    public function conteudo(): View
    {
        return view('conteudo');
    }

    public function historico(): View
    {
        return view('historico');
    }
}
