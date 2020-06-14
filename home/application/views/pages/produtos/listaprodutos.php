<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  <h2>Lista de Produtos</h2>
  <p><?php if(isset($_SESSION["mensagem"])) echo $_SESSION["mensagem"]; unset($_SESSION["mensagem"]); ?></p>          
  <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th><a href="<?=base_url('/produtos/index/descricao')?>">Produto</a></th>
        <th><a href="<?=base_url('/produtos/index/preco')?>">Preço</a></th>
        <th><a href="<?=base_url('/produtos/novo')?>"><button type="button" class="btn btn-primary">Novo</button></a></th>
      </tr>
    </thead>
    <tbody>
        <?php echo form_open("/produtos/exluiprodutoLOTE/");?>
        <?php foreach ($produtos as $produto){ ?>
        <tr>
          <td><?=$produto->id;?></td>
          <td><?=$produto->descricao;?></td>
          <td><?=$produto->preco;?></td>
          <td>
              <a href="<?=base_url('/produtos/editaproduto/')?><?=$produto->id;?>"><button type="button" class="btn btn-warning">Edita</button></a>
          </td>
          <td><?=form_checkbox('chkDeleta[]', $produto->id );?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="5" align="right">
                <?php $botaoSubmit = array('class' => 'btn btn-danger');?>
                <?php echo form_submit('exlui','Exclui',$botaoSubmit);?>
            </td>
        </tr>
    </tbody>
  </table>
</div>
