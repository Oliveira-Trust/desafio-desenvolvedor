<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;
use App\CupomDesconto;

class CarrinhoController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $pedidos = Pedido::where([
            'status' => 'RE',
            'user_id' => Auth::id()
        ])->get();

        return view('carrinho.index', compact('pedidos'));
    }

    public function adicionar()
    {

        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idproduto = $req->input('id');

        $produto = Produto::find($idproduto);
        if (empty($produto->id)) {
            $req->session()->flash('mensagem-falha', 'Produto Não Encontrado Em Nossa Loja!');
            return redirect()->route('carrinho.index');
        }

        $idusuario = Auth::id();

        $idpedido = Pedido::consultaId([
            'user_id' => $idusuario,
            'status' => 'RE' //Reservada
        ]);

        if (empty($idpedido)) {
            $pedido_novo = Pedido::create([
                'user_id' => $idusuario,
                'status' => 'RE'
            ]);

            $idpedido = $pedido_novo->id;
        }

        PedidoProduto::create([
            'pedido_id' => $idpedido,
            'produto_id' => $idproduto,
            'valor' => $produto->valor,
            'status' => 'RE'
        ]);

        $req->session()->flash('mensagem-sucesso', 'Produto Adicionado Ao Carrinho Com Sucesso!');

        return redirect()->route('carrinho.index');
    }

    public function remover()
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idpedido = $req->input('pedido_id');
        $idproduto = $req->input('produto_id');
        $remove_apenas_item = (boolean)$req->input('item');
        $idusuario = Auth::id();

        $idpedido = Pedido::consultaId([
            'id' => $idpedido,
            'user_id' => $idusuario,
            'status' => 'RE' // Reservada
        ]);

        if (empty($idpedido)) {
            $req->session()->flash('mensagem-falha', 'Pedido Não Encontrado!');
            return redirect()->route('carrinho.index');
        }

        $where_produto = [
            'pedido_id' => $idpedido,
            'produto_id' => $idproduto
        ];

        $produto = PedidoProduto::where($where_produto)->orderBy('id', 'desc')->first();
        if (empty($produto->id)) {
            $req->session()->flash('mensagem-falha', 'Produto Não Encontrado No Carrinho!');
            return redirect()->route('carrinho.index');
        }

        if ($remove_apenas_item) {
            $where_produto['id'] = $produto->id;
        }
        PedidoProduto::where($where_produto)->delete();

        $check_pedido = PedidoProduto::where([
            'pedido_id' => $produto->pedido_id
        ])->exists();

        if (!$check_pedido) {
            Pedido::where([
                'id' => $produto->pedido_id
            ])->delete();
        }

        $req->session()->flash('mensagem-sucesso', 'Produto Removido do Carrinho Com Sucesso!');

        return redirect()->route('carrinho.index');
    }

    public function concluir()
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idpedido = $req->input('pedido_id');
        $idusuario = Auth::id();

        $check_pedido = Pedido::where([
            'id' => $idpedido,
            'user_id' => $idusuario,
            'status' => 'RE' // Reservada
        ])->exists();

        if (!$check_pedido) {
            $req->session()->flash('mensagem-falha', 'Pedido Não Encontrado!');
            return redirect()->route('carrinho.index');
        }

        $check_produtos = PedidoProduto::where([
            'pedido_id' => $idpedido
        ])->exists();
        if (!$check_produtos) {
            $req->session()->flash('mensagem-falha', 'Produtos do Pedido Não Encontrado!');
            return redirect()->route('carrinho.index');
        }

        PedidoProduto::where([
            'pedido_id' => $idpedido
        ])->update([
            'status' => 'PA'
        ]);
        Pedido::where([
            'id' => $idpedido
        ])->update([
            'status' => 'PA'
        ]);

        $req->session()->flash('mensagem-sucesso', 'Compra Concluída Com Sucesso!');

        return redirect()->route('carrinho.compras');
    }

    public function compras()
    {
        $compras = Pedido::where([
            'status' => 'PA',
            'user_id' => Auth::id()
        ])->orderBy('created_at', 'desc')->get();

        $cancelados = Pedido::where([
            'status' => 'CA',
            'user_id' => Auth::id()
        ])->orderBy('updated_at', 'desc')->get();

        return view('carrinho.compras', compact('compras', 'cancelados'));
    }

    public function cancelar()
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idpedido = $req->input('pedido_id');
        $idspedido_prod = $req->input('id');
        $idusuario = Auth::id();

        if (empty($idspedido_prod)) {
            $req->session()->flash('mensagem-falha', 'Nenhum Item Selecionado Para Cancelamento!');
            return redirect()->route('carrinho.compras');
        }

        $check_pedido = Pedido::where([
            'id' => $idpedido,
            'user_id' => $idusuario,
            'status' => 'PA' // Pago
        ])->exists();

        if (!$check_pedido) {
            $req->session()->flash('mensagem-falha', 'Pedido Não Encontrado Para Cancelamento!');
            return redirect()->route('carrinho.compras');
        }

        $check_produtos = PedidoProduto::where([
            'pedido_id' => $idpedido,
            'status' => 'PA'
        ])->whereIn('id', $idspedido_prod)->exists();

        if (!$check_produtos) {
            $req->session()->flash('mensagem-falha', 'Produtos do Pedido Não Encontrados!');
            return redirect()->route('carrinho.compras');
        }

        PedidoProduto::where([
            'pedido_id' => $idpedido,
            'status' => 'PA'
        ])->whereIn('id', $idspedido_prod)->update([
            'status' => 'CA'
        ]);

        $check_pedido_cancel = PedidoProduto::where([
            'pedido_id' => $idpedido,
            'status' => 'PA'
        ])->exists();

        if (!$check_pedido_cancel) {
            Pedido::where([
                'id' => $idpedido
            ])->update([
                'status' => 'CA'
            ]);

            $req->session()->flash('mensagem-sucesso', 'Compra Cancelada Com Sucesso!');

        } else {
            $req->session()->flash('mensagem-sucesso', 'Item(ns) da Compra Cancelado(s) Com Sucesso!');
        }

        return redirect()->route('carrinho.compras');
    }
}
