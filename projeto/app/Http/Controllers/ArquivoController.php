<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArquivoController extends Controller
{
    public function arquivos(): View
    {
        $arquivos = Arquivo::query()->paginate();
        return view('index', compact('arquivos'));
    }

    public function importar(): View
    {
        return view('importar');
    }

    public function historico(): View
    {
        return view('historico');
    }
}
