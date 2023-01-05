<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $moedas = [
            ['sigla' =>  'USD', 'nome'   =>  'Dólar Americano'],
            ['sigla' =>  'CAD', 'nome'   =>  'Dólár Canadense'],
            ['sigla' =>  'EUR', 'nome'   =>  'Euro'],
            ['sigla' =>  'BTC', 'nome'   =>  'Bitcoin'],
        ];

        return view('home', compact('moedas'));
    }
}
