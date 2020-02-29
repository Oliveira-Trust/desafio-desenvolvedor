<?php

namespace App\Http\Controllers;

use App\clientes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Pedidos;
use Exception;

class PedidosApiController extends Controller
{
    public function index()
    {
        // $pedidos = Pedidos::all();
        $pedidos = Pedidos::with('Produtos')
            ->with('Clientes')
            ->get();

        return response()->json($pedidos);
    }

    public function show($id)
    {
        $pedido = Pedidos::find($id);

        if (!$pedido) {
            return response()->json([
                'message'   => 'Record not found',
                'code'   => 500,
            ], 500);
        } else {
            return response()->json([
                'message'   => 'Record found',
                'code'   => 200,
                'data' => $pedido,
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $pedido = new Pedidos();
        $message = "";
        $code = 0;


        try {
            $pedido->fill($request->all());
            $pedido->save();

            $message = "Record Stored";
            $code = 200;
        } catch (Exception $ex) {
            $message = "Generic Error";
            $code = 500;
        }

        return response()->json([
            'message'   => $message,
            'code'   => $code,
        ], $code);
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedidos::find($id);

        if (!$pedido) {
            $message   = 'Record not found';
            $code = 500;
        }

        try {

            $pedido->fill($request->all());
            $pedido->save();

            $code = 200;
            $message   = 'Record Updated';
        } catch (Exception $ex) {
            $message = 'Generic Error';
            $code = 500;
        }

        return response()->json([
            'message'   => $message,
            'code'   => $code,
        ], $code);
    }

    public function destroy($id)
    {
        $pedido = Pedidos::findOrFail($id);
        $code = 200;
        $message = "";

        if (!$pedido) {
            $message = 'Record not found';
            $code = 500;
        }

        try {
            $pedido->delete();

            $code = 200;
            $message   = 'Record Deleted';
        } catch (Exception $ex) {
            $message = 'Generic Error';
            $code = 500;
        }

        return response()->json([
            'message'   => $message,
            'code'   => $code,
        ], $code);
    }
}
