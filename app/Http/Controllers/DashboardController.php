<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\PedidosCompra;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $user = Auth::user();
        $pedidoCount = PedidosCompra::count();
        $clienteCount = Cliente::count();
        $produtoCount = Produto::count();

        return view('dashboard', [
            'user' => $user,
            'pedidoCount' => $pedidoCount,
            'clienteCount' => $clienteCount,
            'produtoCount' => $produtoCount
        ]);
    }
}