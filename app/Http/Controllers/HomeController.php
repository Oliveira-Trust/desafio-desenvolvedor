<?php

namespace App\Http\Controllers;

use App\Contracts\PagamentoInterface;
use App\Contracts\TaxaInterface;

class HomeController extends Controller
{
    private $pagamentoRepository;

    public function __construct(PagamentoInterface $pagamentoRepository)
    {
        $this->pagamentoRepository = $pagamentoRepository;
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $moedas = [
            ['sigla' =>  'USD', 'nome'   =>  'Dólar Americano'],
            ['sigla' =>  'CAD', 'nome'   =>  'Dólár Canadense'],
            ['sigla' =>  'EUR', 'nome'   =>  'Euro'],
            ['sigla' =>  'BTC', 'nome'   =>  'Bitcoin'],
        ];

        $pagamentos = $this->pagamentoRepository->listarDoUsuario($userId);

        return view('home', compact('moedas', 'pagamentos'));
    }
}
