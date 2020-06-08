<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  <h2>Lista de Pedidos</h2>
  <p></p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th><a href="<?=base_url('/pedidos/index/id')?>">ID</a></th>
        <th><a href="<?=base_url('/pedidos/index/nome')?>">Cliente</a></th>
        <th><a href="<?=base_url('/pedidos/index/descricao')?>">Produto</a></th>
        <th><a href="<?=base_url('/pedidos/index/dataPedido')?>">Data do Pedido</a></th>
        <th><a href="<?=base_url('/pedidos/index/status')?>">Status</a></th>
        <th><a href="<?=base_url('/pedidos/novo')?>"><button type="button" class="btn btn-primary">Novo</button></a></th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($pedidos as $pedido){ ?>
        <tr>
          <td><?=$pedido->idPedido;?></td>
          <td><?=$pedido->nome;?></td>
          <td><?=$pedido->descricao;?></td>
          <td><?=$pedido->dataPedido;?></td>
          <td><?=$pedido->status;?></td>
          <td>
              <a href="<?=base_url('/pedidos/editapedido/')?><?=$pedido->id;?>"><button type="button" class="btn btn-warning">Edita</button></a>
              <a href="<?=base_url('/pedidos/excluipedido/')?><?=$pedido->id;?>"><button type="button" class="btn btn-danger">Exclui</button></a>
              
          </td>
        </tr>
        <?php } ?>
    </tbody>
  </table>
</div>
