<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  <h2>Lista de Pedidos</h2>
  <p></p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th><a href="<?=base_url('/pedidos/index/nome')?>">Cliente</a></th>
        <th><a href="<?=base_url('/pedidos/index/descricao')?>">Produto</a></th>
        <th><a href="<?=base_url('/pedidos/index/dataPedido')?>">Data do Pedido</a></th>
        <th><a href="<?=base_url('/pedidos/index/status')?>">Status</a></th>
        <th><a href="<?=base_url('/pedidos/novo')?>"><button type="button" class="btn btn-primary">Novo</button></a></th>
      </tr>
    </thead>
    <tbody>
        <?php //print_r($pedidos);?>
        <?php foreach ($pedidos as $pedido){ ?>
        <tr>
          <td><?=$pedido->idPedido;?></td>
          <td><a href="<?=base_url('/clientes/editacliente/'.$pedido->idClientes)?>"'><span class="glyphicon glyphicon-pencil"></span></i></a> <?=$pedido->nome;?></td>
          <td><a href="<?=base_url('/produtos/editaproduto/'.$pedido->idProdutos)?>"'><span class="glyphicon glyphicon-pencil"></span></i></a> <?=$pedido->descricao;?></td>
          <td><?=$pedido->dataPedido;?></td>
          <td><?=exibeStatus($pedido->status);?></td>
          <td>
              <a href="<?=base_url('/pedidos/editapedido/')?><?=$pedido->idPedido;?>"><button type="button" class="btn btn-warning">Edita</button></a>
              <a href="<?=base_url('/pedidos/excluipedido/')?><?=$pedido->idPedido;?>"><button type="button" class="btn btn-danger">Exclui</button></a>
              
          </td>
        </tr>
        <?php } ?>
    </tbody>
  </table>
</div>


<?php
function exibeStatus($intStatus){
    
    switch ($intStatus) {
      case 1:
        return "Aberto";
        break;
      case 2:
        return "Pago";
        break;
      case 3:
        return "Cancelado";
        break;
    }
    
}
?>