<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;
use App\User;

use Illuminate\Support\Facades\Auth;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\DB;

use App\Utils\Util;

class PedidosService
{
    public $listaOrdenacao = [
        'cliente_id' => 'Cliente',
        'produto_id' => 'Produto'
    ];

    public function __construct()
    {
    }

    public function obterListaInicial(Request $request)
    {
        $pedidos = Pedido::
                        select([
                            'pedidos.id as id',
                            DB::raw("DATE_FORMAT(pedidos.dt_pedido, '%d/%m/%Y') as dtPedido"),
                            'clientes.id as idCliente',
                            'clientes.nm_cliente as nmCliente',
                            'produtos.id as idProduto',
                            'produtos.foto as fotoProduto',
                            'produtos.nm_produto as nmProduto',
                            DB::raw("FORMAT(produtos.vl_produto, 2, 'de_DE') as vlProduto"),
                            'pedidos_status.nm_status as nmStatus',
                            DB::raw("case
                                        when pedidos_status.id = 1 then 'info'
                                        when pedidos_status.id = 2 then 'success'
                                        when pedidos_status.id = 3 then 'danger' end as classStatus")
                        ])
                        ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
                        ->join('produtos', 'produtos.id', '=', 'pedidos.produto_id')
                        ->join('pedidos_status', 'pedidos_status.id', '=', 'pedidos.pedido_status_id')
                        ->where('pedidos.in_ativo', '=', 1)
                        ->groupBy('pedidos.id')->paginate();
        return $pedidos;
    }

    public function filtrar(Request $request)
    {
        $dados = $request->all();
        $pedidos = Pedido::
                            select([
                                'pedidos.id as id',
                                DB::raw("DATE_FORMAT(pedidos.dt_pedido, '%d/%m/%Y') as dtPedido"),
                                'clientes.id as idCliente',
                                'clientes.nm_cliente as nmCliente',
                                'produtos.id as idProduto',
                                'produtos.foto as fotoProduto',
                                'produtos.nm_produto as nmProduto',
                                DB::raw("FORMAT(produtos.vl_produto, 2, 'de_DE') as vlProduto"),
                                'pedidos_status.nm_status as nmStatus',
                                DB::raw("case
                                            when pedidos_status.id = 1 then 'info'
                                            when pedidos_status.id = 2 then 'success'
                                            when pedidos_status.id = 3 then 'danger' end as classStatus")
                            ])
                            ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
                            ->join('produtos', 'produtos.id', '=', 'pedidos.produto_id')
                            ->join('pedidos_status', 'pedidos_status.id', '=', 'pedidos.pedido_status_id')
                            ->where($this->filtro($dados))
                            ->groupBy('pedidos.id')
                            ->orderBy($dados['campo_ordenacao'], $dados['tp_ordem'])
                            ->paginate();
        return $pedidos;
    }

    private function filtro($dados){
        $condicao[] = ['pedidos.in_ativo', '=', 1];

        extract($dados);

        if(isset($dt_pedido) && !empty($dt_pedido))
            $condicao[] = ['pedidos.dt_pedido', '=',  Util::formataDataParaUs($dt_pedido)];

        if(isset($cliente_id) && !empty($cliente_id))
            $condicao[] = ['clientes.id', '=', $cliente_id];

        if(isset($produto_id) && !empty($produto_id))
            $condicao[] = ['produtos.id', '=', $produto_id];

        if(isset($pedido_status_id) && !empty($pedido_status_id))
            $condicao[] = ['pedidos.pedido_status_id', '=', $pedido_status_id];

        return $condicao;
    }

    public function salvar(Request $request)
    {
        $dados = $request->all();

        if(isset($dados['id']) && !empty($dados['id'])){
            $this->atualizar($dados, $request);
        }else {
            $this->adicionar($dados, $request);
        }
    }

    private function adicionar($dados, Request $request)
    {
        $pedido = new Pedido();
        $pedido->usuario_id = Auth::user()->id;
        $pedido->dt_pedido = Util::formataDataParaUs($dados['dt_pedido']);
        $pedido->cliente_id = $dados['cliente_id'];
        $pedido->produto_id = $dados['produto_id'];
        $pedido->pedido_status_id = $dados['pedido_status_id'];
        $pedido->in_ativo = 1;
        $pedido->save();
    }

    private function atualizar($dados, Request $request)
    {
        $pedido = Pedido::find($dados['id']);
        $pedido->dt_pedido = Util::formataDataParaUs($dados['dt_pedido']);
        $pedido->cliente_id = $dados['cliente_id'];
        $pedido->produto_id = $dados['produto_id'];
        $pedido->pedido_status_id = $dados['pedido_status_id'];
        $pedido->save();
    }

    public function inativar($id)
    {
        $pedido = Pedido::find($id);
        $pedido->in_ativo = 0;
        $pedido->save();
    }

    public function inativarPedidosMarcados(Request $request)
    {
        if(!empty($request->input('ids'))){
            $ids = $request->input('ids');
            foreach($ids as $id){
                $this->inativar($id);
            }
        }
    }

    public function obterPorId($id)
    {
        return Pedido::select(['pedidos.*', DB::raw("DATE_FORMAT(pedidos.dt_pedido, '%d/%m/%Y') as dtPedido"),])->find($id);
    }

    public function obterTodos()
    {
        return Pedido::where('in_ativo', '=', 1)->get();
    }

    public function qtdTotalRegistros()
    {
        return Pedido::where('in_ativo', '=', 1)->count();
    }
}