<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Services\PedidosService;
use App\Http\Services\ClientesService;
use App\Http\Services\ProdutosService;

class ApiController extends Controller
{
    private $pedidosService;
    private $clientesService;
    private $produtosService;

    function __construct(){
        $this->pedidosService = new PedidosService();
        $this->clientesService = new ClientesService();
        $this->produtosService = new ProdutosService();
    }

    #- salvar registro na tabela "pedidos"
    public function salvarPedido(Request $request)
    {
        try {
            $this->pedidosService->salvar($request);
            return response()->json(['success' => true], 200);
        }catch(Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    #- lista de todos os registros da tabela "pedidos"
    public function obterTodosPedidos()
    {
        try {
            return response()->json($this->pedidosService->obterTodos());
        }catch(Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    #- salvar registro na tabela "clientes"
    public function salvarCliente(Request $request)
    {
        try {
            $this->clientesService->salvar($request);
            return response()->json(['success' => true], 200);
        }catch(Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    #- lista de todos os registros da tabela "clientes"
    public function obterTodosClientes()
    {
        try {
            return response()->json($this->clientesService->obterTodos());
        }catch(Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    #- salvar registro na tabela "produtos"
    public function salvarProduto(Request $request)
    {
        try {
            $this->produtosService->salvar($request);
            return response()->json(['success' => true], 200);
        }catch(Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    #- lista de todos os registros da tabela "produtos"
    public function obterTodosProdutos()
    {
        try {
            return response()->json($this->produtosService->obterTodos());
        }catch(Exception $e){
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}