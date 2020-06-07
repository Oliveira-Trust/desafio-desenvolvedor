<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container" style="height:200px;">
  <div class="row bg-primary text-white">
    <div class="col-sm-3">
        <img src="<?=base_url('assets/img/Logo.png')?>" width="200px;" height="100px;">
    </div>
    <div class="col-sm-9">
        <h4>Sistema de Pedidos XPTO</h4>
    </div>
</div>

<div class="container">
  <div class="jumbotron">
        <?php if(isset($mensagens)) echo $mensagens; ?>
      <p>Acesse o sistema</p>
      <?php MontaFormLogin(); ?>
      <br>
  </div>
</div>
  
<div class="container">
  <div class="row">
    <div class="col-sm-3">
      <p><a href="home">Voltar</a></p>
    </div>
  </div>
</div>

<?php

function MontaFormLogin(){
    
    //Carrega as funções
    echo form_open("/sysot/valida");
    
    //Campo usuario
    echo form_label('','usuario');
    $campoUsuario = array(
        'name' => 'usuario',
        'maxlength' => '6',
        'placeholder' => 'Usuário com 6 caracteres',
        'class' => 'form-control'
    );
    echo form_input($campoUsuario, set_value('usuario'));
    
    //Campo senha
    echo form_label('','senha');
    $campoSenha = array(
        'name' => 'senha',
        'maxlength' => '6',
        'placeholder' => 'Senha com 6 caracteres',
        'class' => 'form-control'
    );
    echo form_input($campoSenha, set_value('senha'));
    
    echo '<br><br>';
    
    // Botão submit
    $botaoSubmit = array(
        'class' => 'btn btn-primary'
    );
    echo form_submit('valida','Autenticar',$botaoSubmit);
    
}
?>