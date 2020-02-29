<?php

namespace App\Http\Controllers;

use App\clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ClientesWebController extends Controller
{

    public function index()
    {
        return view('clientes.lista');
    }

    public function show($id)
    {
        if (is_numeric($id)) {
            $cliente = Clientes::find($id);

            return view('clientes.show',
            ['cliente' => $cliente]);
        } else {

            return response()->json([
                'message'   => 'Record not found',
                'code'   => 404,
            ], 404);
        }
    }
}
