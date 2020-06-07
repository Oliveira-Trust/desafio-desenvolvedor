<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  <div class="container">
  <div class="jumbotron">
      
      <?php if(isset($formerror)) echo $formerror; ?>
      
      <h2>Edita Cliente</h2>
      
      <?php MontaFormLogin($clientes); ?>
      
      <br>
  </div>
    </div>
</div>

<?php
function MontaFormLogin($clientes){
    
    //Carrega as funções
    echo form_open("/clientes/salva");
    
    //Campo nome
    echo form_label('','Nome');
    $campoNome= array(
        'name' => 'txtNome',
        'value' => $clientes->nome,
        'maxlength' => '100',
        'placeholder' => 'Nome com 100 caracteres',
        'class' => 'form-control'
    );
    echo form_input($campoNome, set_value('txtNome'));
    
    //Campo senha
    echo form_label('','Senha');
    $campoSenha = array(
        'name' => 'pasSenha',
        'value' => $clientes->senha,
        'maxlength' => '6',
        'placeholder' => 'Senha com 6 caracteres',
        'class' => 'form-control'
    );
    echo form_input($campoSenha, set_value('pasSenha'));
    
    //Campo email
    echo form_label('','Email');
    $campoEmail = array(
        'name' => 'txtEmail',
        'value' => $clientes->email,
        'maxlength' => '50',
        'placeholder' => 'E-mail com 50 caracteres',
        'class' => 'form-control'
    );
    echo form_input($campoEmail, set_value('txtEmail'));
    
    echo '<br><br>';
    
    // Botão submit
    $botaoSubmit = array(
        'class' => 'btn btn-primary'
    );
    echo form_submit('salva','Salvar',$botaoSubmit);
    
}
?>
