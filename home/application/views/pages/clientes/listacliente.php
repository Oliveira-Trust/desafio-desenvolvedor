<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  <h2>Lista de Clientes</h2>
  <p><?php if(isset($_SESSION["mensagem"])) echo $_SESSION["mensagem"]; unset($_SESSION["mensagem"]); ?></p>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th><a href="<?=base_url('/clientes/index/nome')?>">Nome</a></th>
        <th><a href="<?=base_url('/clientes/index/email')?>">E-mail</a></th>
        <th><a href="<?=base_url('/clientes/novo')?>"><button type="button" class="btn btn-primary">Novo</button></a></th>
      </tr>
    </thead>
    <tbody>
        <?php echo form_open("/clientes/exluiclienteLOTE/");?>
        <?php foreach ($clientes as $cliente){ ?>
        <tr>
          <td><?=$cliente->id;?></td>
          <td><?=$cliente->nome;?></td>
          <td><?=$cliente->email;?></td>
          <td>
              <a href="<?=base_url('/clientes/editacliente/')?><?=$cliente->id;?>"><button type="button" class="btn btn-warning">Edita</button></a>
          </td>
          <td><?=form_checkbox('chkDeleta[]', $cliente->id );?></td>
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
