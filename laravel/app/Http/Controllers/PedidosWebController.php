<?php

namespace App\Http\Controllers;

use App\clientes;
use App\pedidos;
use App\produtos;
use Illuminate\Http\Request;

class PedidosWebController extends Controller
{
    public function index()
    {
        return view('pedidos.lista');
    }

    public function showProdutos($id)
    {
        if (is_numeric($id)) {
            $pedidos = pedidos::where('idProduto', $id)->with('Produtos')->with('Clientes')->get();
            $produto = $pedidos[0]->Produtos;

            return view('pedidos.show', ['section' => 'produtos', 'pedidos' => $pedidos, 'produto' => $produto]);
        } else {
            return response()->json([
                'message'   => 'Record not found',
                'code'   => 404,
            ], 404);
        }
    }

    public function showClientes($id)
    {
        if (is_numeric($id)) {
            $pedidos = pedidos::where('idCliente', $id)->with('Produtos')->with('Clientes')->get();
            $cliente = $pedidos[0]->Clientes;

            return view('pedidos.show', ['section' => 'clientes', 'pedidos' => $pedidos, 'cliente' => $cliente]);
        } else {
            return response()->json([
                'message'   => 'Record not found',
                'code'   => 404,
            ], 404);
        }
    }
}
