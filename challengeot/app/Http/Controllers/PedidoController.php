<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use DB;

class PedidoController extends Controller
{
    protected $pedido;

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    public function pedidosGet(){
        $pedido = $this->pedido->all();

        dd($pedido);
    }

    public function pedidoGet($id){
        dd('oi');
    }

    public function pedidoCreate(){
        dd('oi');
    }
    public function pedidoUpdate(){
        dd('oi');
    }
    public function pedidoDelete(){
        dd('oi');
    }
}
