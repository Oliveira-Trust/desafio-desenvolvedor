<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  <h2>Lista de Produtos</h2>
  <p></p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th><a href="<?=base_url('/produtos/index/id')?>">ID</a></th>
        <th><a href="<?=base_url('/produtos/index/descricao')?>">Produto</a></th>
        <th><a href="<?=base_url('/produtos/index/preco')?>">Preço</a></th>
        <th><a href="<?=base_url('/produtos/novo')?>"><button type="button" class="btn btn-primary">Novo</button></a></th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto){ ?>
        <tr>
          <td><?=$produto->id;?></td>
          <td><?=$produto->descricao;?></td>
          <td><?=$produto->preco;?></td>
          <td>
              <a href="<?=base_url('/produtos/editaproduto/')?><?=$produto->id;?>"><button type="button" class="btn btn-warning">Edita</button></a>
              <a href="<?=base_url('/produtos/excluiproduto/')?><?=$produto->id;?>"><button type="button" class="btn btn-danger">Exclui</button></a>
              
          </td>
        </tr>
        <?php } ?>
    </tbody>
  </table>
</div>
