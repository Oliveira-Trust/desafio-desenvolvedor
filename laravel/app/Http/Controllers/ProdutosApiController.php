<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Produtos;
use Exception;

class ProdutosApiController extends Controller
{
    public function index()
    {
        $produtos = Produtos::all();

        return response()->json($produtos);
    }

    public function show($id)
    {
        $produto = Produtos::find($id);

        if (!$produto) {
            return response()->json([
                'message'   => 'Record not found',
                'code'   => 500,
            ], 500);
        }else{
            return response()->json([
                'message'   => 'Record found',
                'code'   => 200,
                'data' => $produto,
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $produto = new Produtos();

        try {
            $produto->fill($request->all());
            $produto->save();

            return response()->json($produto, 201);
        } catch (Exception $ex) {

            return response()->json([
                'message'   => 'Generic Error',
            ], 500);
        }


    }

    public function update(Request $request, $id)
    {
        $produto = Produtos::find($id);

        if (!$produto) {
            $message   = 'Record not found';
            $code = 500;
        }

        try {

            $produto->fill($request->all());
            $produto->save();

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
        $produto = Produtos::findOrFail($id);
        $code = 200;
        $message = "";

        if (!$produto) {
            $message = 'Record not found';
            $code = 500;
        }

        try {
            $produto->delete();

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
