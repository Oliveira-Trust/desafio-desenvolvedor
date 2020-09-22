<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return view('admin.pedido.index', compact('pedidos'));
    }

    public function deletar(Request $req, $id)
    {

        Pedido::find($id)->delete();

        $req->session()->flash('admin-mensagem-sucesso', 'Pedido Deletado Com Sucesso!');

        return redirect()->route('admin.pedidos');
    }
}
