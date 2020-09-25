<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Utils\Util;

use App\Http\Services\PedidosService;
use App\Http\Services\ClientesService;
use App\Http\Services\ProdutosService;
use App\Http\Services\PedidosStatusService;

class HomeController extends Controller
{
    private $pedidosService;
    private $clientesService;
    private $produtosService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->pedidosService = new PedidosService();
        $this->clientesService = new ClientesService();
        $this->produtosService = new ProdutosService();
    }

    public function index()
    {
        $dados = [
            'totalPedidos' => $this->pedidosService->qtdTotalRegistros(),
            'totalClientes' => $this->clientesService->qtdTotalRegistros(),
            'totalProdutos' => $this->produtosService->qtdTotalRegistros()
        ];
        return view('home', $dados);
    }
}