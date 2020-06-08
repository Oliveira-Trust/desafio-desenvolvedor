<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
  <div class="container">
  <div class="jumbotron">
      
      <?php if(isset($formerror)) echo $formerror; ?>
      
      <h2>Edita Pedido</h2>
      
      <?php MontaFormLogin($pedidos,$clientes,$produtos); ?>
      
      <br>
  </div>
    </div>
</div>

<?php
function MontaFormLogin($pedidos,$clientes,$produtos){
    
    print_r($pedidos);
    
    //Carrega as funções
    echo form_open("/pedidos/salva");
    
    //Campo cliente
    echo form_label('','Cliente');
    // Forma as opções
    $campoCliente[0] =  "Selecione o cliente";
    foreach ($clientes as $cliente){
        $campoCliente[$cliente->id] =  $cliente->nome ;
    };
    // Estilos
    $campoClienteEstilo = "class='form-control'";
            
    echo form_dropdown('slcCliente',$campoCliente, '' ,$campoClienteEstilo);
    
    //Campo produto
    echo form_label('','Produto');
    // Forma as opções
    $campoProduto[0] =  "Selecione o produto" ;
    foreach ($produtos as $produto){
        $campoProduto[$produto->id] =  $produto->descricao ;
    };
    // Extras
    $campoProdutoExtras = "class='form-control' onChange='AtualizaPreco(this.value)'";

    echo form_dropdown('slcProduto',$campoProduto, $pedidos->idProduto, $campoProdutoExtras);
    
    //Campo tipo hiden para preco do produto
    $campoPrecoProduto[0] =  "0.00" ;
    foreach ($produtos as $produto){
        $campoPrecoProduto[$produto->id] =  $produto->preco ;
    };
    
    echo form_hidden($campoPrecoProduto);
    
    //Campo Valor do pedido
    echo form_label('','Valor');
    $campoValor = array(
        'name' => 'numValor',
        'id' => 'numVal',
        'min' => '1',
        'max' => '99999999',
        'value' => $pedido->valor,
        'placeholder' => 'Valor do pedido',
        'class' => 'form-control'
    );
    echo form_input($campoValor, set_value('numValor'));
    
    echo '<br><br>';
    
    // Botão submit
    $botaoSubmit = array(
        'class' => 'btn btn-primary'
    );
    echo form_submit('salva','Salvar',$botaoSubmit);
    
}
?>

<script>
// Atualiza preco
function AtualizaPreco(intIdProduto) {
    
    var indice = document.getElementsByName(intIdProduto);
    
    document.getElementById("numVal").value = indice[0].value;
        
    
}

</script>