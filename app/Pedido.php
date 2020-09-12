<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{

  protected $fillable = ['status', 'cliente_id', 'produto_id'];
  /**
   * insere o Pedido 
   *
   * @param  \App\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function inserirPedido($pedido)
  {
    $res = $this->firstOrCreate([
      'status' => $pedido['status'],
      'cliente_id' => $pedido['cliente_id'],
      'produto_id' => $pedido['produto_id']
    ]);

    return  $res;
  }

  /**
   * altera o Pedido 
   *
   * @param  \App\Pedido $pedido
   * @return \Illuminate\Http\Response
   */
  public function alterarPedido($id, $dados)
  {
    $pedido =  $this->find($id);
    if (empty($pedido)) {
      return false;
    }
    $res = $pedido->update($dados->all());
    return $res;
  }

  /**
   * lista o Pedido 
   *
   * @param  \App\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function findListarPedido($id)
  {
    $res =  $this->find($id);
    return $res;
  }
  /**
   * lista o Pedido 
   *
   * @param  \App\Pedido  $pedido
   * @return \Illuminate\Http\Response
   */
  public function listarPedido()
  {
    $pedido = Pedido::select([
      'pedidos.id',
      'pedidos.cliente_id',
      'pedidos.produto_id',
      'clientes.nome',
      'clientes.cpf',
      'produtos.nome_produto',
      'produtos.descricao_produto',
      'pedidos.status',
      DB::raw("CASE PEDIDOS.STATUS WHEN 0 THEN 'EM ABERTO' WHEN 1 THEN 'PAGO' WHEN 2 THEN 'CANCELADO' END as status_nome")
    ])
      ->join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
      ->join('produtos', 'produtos.id', '=', 'pedidos.produto_id')
      ->get();

    return $pedido;
  }
  public function deletarPedido($id)
  {
    $pedido = Pedido::find($id);
    $res =  $pedido->delete();
    return  $res;
  }
}
