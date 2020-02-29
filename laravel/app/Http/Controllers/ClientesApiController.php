<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Clientes;
use Exception;

class ClientesApiController extends Controller
{
    public function index()
    {
        $clientes = Clientes::all();

        return response()->json($clientes);
    }

    public function show($id)
    {
        $cliente = Clientes::find($id);

        if (!$cliente) {
            return response()->json([
                'message'   => 'Record not found',
                'code'   => 500,
            ], 500);
        }else{
            return response()->json([
                'message'   => 'Record found',
                'code'   => 200,
                'data' => $cliente,
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $cliente = new Clientes();

        try {
            $cliente->fill($request->all());
            $cliente->save();

            return response()->json($cliente, 201);
        } catch (Exception $ex) {

            return response()->json([
                'message'   => 'Generic Error',
            ], 500);
        }


    }

    public function update(Request $request, $id)
    {
        $cliente = Clientes::find($id);

        if (!$cliente) {
            $message   = 'Record not found';
            $code = 500;
        }

        try {

            $cliente->fill($request->all());
            $cliente->save();

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
        $cliente = Clientes::findOrFail($id);
        $code = 200;
        $message = "";

        if (!$cliente) {
            $message = 'Record not found';
            $code = 500;
        }

        try {
            $cliente->delete();

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
