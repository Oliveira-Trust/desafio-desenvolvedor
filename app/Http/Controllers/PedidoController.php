<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;
use App\Http\Requests\PedidoRequest;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $pedido = new Pedido();
            $rest = $pedido->listarPedido();
            //dd(response()->json($rest, 200));
            return  response()->json($rest, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }

    public function view_pedido()
    {
        return view('pedido');
    }

    public function view_novo_pedido()
    {
        return view('novo_pedido');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PedidoRequest $request)
    {
        try {
          
            $pedido = new Pedido();
            $return = $pedido->inserirPedido($request);
            return $return;
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $pedido = new Pedido();
            $ret = $pedido->findListarPedido($id);
            return response()->json($ret, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(PedidoRequest $request,  $id)
    {
        try {
            $pedidoModel = new Pedido();
            $ret = $pedidoModel->alterarPedido($id, $request);
            return response()->json([
                $ret
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pedidoModel = new Pedido();
            $ret = $pedidoModel->deletarPedido($id);
            return response()->json([
                $ret
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
       


    }
}
