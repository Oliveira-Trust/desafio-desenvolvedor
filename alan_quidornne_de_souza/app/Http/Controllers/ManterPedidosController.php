<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Utils\Util;

use App\Http\Services\PedidosService;
use App\Http\Services\ClientesService;
use App\Http\Services\ProdutosService;
use App\Http\Services\PedidosStatusService;

use Redirect;

class ManterPedidosController extends Controller
{
    private $pedidosService;
    private $clientesService;
    private $produtosService;
    private $pedidosStatusService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->pedidosService = new PedidosService();
        $this->clientesService = new ClientesService();
        $this->produtosService = new ProdutosService();
        $this->pedidosStatusService = new PedidosStatusService();
    }

    public function manter(Request $request)
    {
        try {
            $pedidos = $this->pedidosService->obterListaInicial($request);
            return view('pedidos.manter', [
                'pedidos' => $pedidos,
                'listaOrdenacao' => $this->pedidosService->listaOrdenacao,
                'combos' => $this->combos()
            ])->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }

    public function filtrar(Request $request)
    {
        if($request->isMethod('post')){
            try {
                $pedidos = $this->pedidosService->filtrar($request);
                return view('pedidos.manter', [
                    'pedidos' => $pedidos,
                    'listaOrdenacao' => $this->pedidosService->listaOrdenacao,
                    'campos' => $request->all(),
                    'combos' => $this->combos()
                ])->with('success', $this->msgSucesso);
            }catch(Exception $e){
                return view('error.500');
            }
        }else {
            return view('pedidos.manter'); 
        }
    }

    public function salvar(Request $request)
    {
        try {
            $this->pedidosService->salvar($request);
            return redirect()->route('manterPedidos')->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }

    public function inativar($id)
    {
        try {
            $this->pedidosService->inativar($id);
            return redirect()->route('manterPedidos')->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }

    public function obterPorId($id)
    {
        return response()->json($this->pedidosService->obterPorId($id));
    }

    public function inativarPedidosMarcados(Request $request)
    {
        try {
            $this->pedidosService->inativarPedidosMarcados($request);
            return redirect()->route('manterPedidos')->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }

    private function combos()
    {
        return [
            'produtos' => $this->produtosService->obterTodos(),
            'clientes' => $this->clientesService->obterTodos(),
            'status' => $this->pedidosStatusService->obterTodos()
        ];
    }
}