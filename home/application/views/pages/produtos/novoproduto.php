<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  <div class="container">
  <div class="jumbotron">
      
      <?php if(isset($formerror)) echo $formerror; ?>
      
      <h2>Novo Produto</h2>
      
      <?php MontaFormLogin(); ?>
      
      <br>
  </div>
    </div>
</div>

<?php
function MontaFormLogin(){
    
    //Carrega as funções
    echo form_open("/produtos/salva");
    
    //Campo descricao
    echo form_label('','Descrição');
    $campoDescricao= array(
        'name' => 'txtDescricao',
        'maxlength' => '50',
        'placeholder' => 'Descrição com 50 caracteres',
        'class' => 'form-control'
    );
    echo form_input($campoDescricao, set_value('txtDescricao'));
    
    //Campo preco
    echo form_label('','Preço');
    $campoPreco = array(
        'name' => 'numPreco',
        'type' => 'number',
        'min' => '1',
        'max' => '99999999',
        'placeholder' => 'Preço até 9999999.99',
        'class' => 'form-control'
    );
    echo form_input($campoPreco, set_value('numPreco'));
        
    echo '<br><br>';
    
    // Botão submit
    $botaoSubmit = array(
        'class' => 'btn btn-primary'
    );
    echo form_submit('salva','Salvar',$botaoSubmit);
    
}
?>
