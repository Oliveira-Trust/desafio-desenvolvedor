<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $cliente = new Cliente();
            $ret = $cliente->listarCliente();
            return response()->json($ret, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao Enviar ' . $e->getMessage()
            ], 400);
        }
    }


    public function view_cliente()
    {
        return view('cliente');
    }

    public function view_novo_cliente()
    {
        return view('novo_cliente');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        try {
            $cliente = new Cliente();
            $ret = $cliente->inserirCliente($request);
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
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $clientes = new Cliente();
            $ret = $clientes->findListarCliente($id);
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
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request,  $id)
    {
        try {
          
            $clienteModel = new Cliente();
            $ret = $clienteModel->alterarCliente($id, $request);
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
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
