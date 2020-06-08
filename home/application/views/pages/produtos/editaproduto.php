<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  <div class="container">
  <div class="jumbotron">
      
      <?php if(isset($formerror)) echo $formerror; ?>
      
      <h2>Edita Produto</h2>
      
      <?php MontaFormLogin($produtos); ?>
      
      <br>
  </div>
    </div>
</div>

<?php
function MontaFormLogin($produtos){
    
    //Carrega as funções
    echo form_open("/produtos/salva/");
    
    $campoId= array(
        'name' => 'id',
        'value' => $produtos->id,
        'type' => 'hidden'
    );
    echo form_input($campoId, set_value('id'));
    
    //Campo nome
    echo form_label('','Descrição');
    $campoDescricao= array(
        'name' => 'txtDescricao',
        'value' => $produtos->descricao,
        'maxlength' => '50',
        'placeholder' => 'Descrição com 50 caracteres',
        'class' => 'form-control'
    );
    echo form_input($campoDescricao, set_value('txtDescricao'));
    
    //Campo Preco
    echo form_label('','Preço');
    $campoPreco= array(
        'name' => 'numPreco',
        'value' => $produtos->preco,
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
