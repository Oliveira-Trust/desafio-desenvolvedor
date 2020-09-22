<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        return Pedido::all();

        return response()->json();
    }

    public function store(Request $req)
    {
        Pedido::create($req->all());
    }

    public function show($id)
    {
        return Pedido::findOrFail($id);
    }

    public function update(Request $req, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update($req->all());
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();
    }
}
