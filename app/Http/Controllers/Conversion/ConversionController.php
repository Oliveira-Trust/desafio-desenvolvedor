<?php

namespace App\Http\Controllers\Conversion;

use App\Http\Controllers\Controller;

class ConversionController extends Controller
{

    /**
     * Carregar pagina web.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
