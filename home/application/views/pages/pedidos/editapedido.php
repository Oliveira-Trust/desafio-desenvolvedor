<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container">
    <div class="container">
        <div class="jumbotron">
      
            <?php if(isset($formerror)) echo $formerror; ?>

            <h2>Edita Pedido</h2>

            <?php MontaForm($pedidos,$clientes,$produtos); ?>

            <br>
        </div>
    </div>
</div>

<?php
function MontaForm($pedidos,$clientes,$produtos){
    
    //print_r($pedidos);
    
    //Carrega as funções
    echo form_open("/pedidos/salva");
    
    //Id do pedido
    echo form_hidden('hidIdPedido', $pedidos[0]->idPedido );
    
    //Campo cliente
    echo form_label('','Cliente');
    // Forma as opções
    $campoCliente[''] =  "Selecione o cliente";
    foreach ($clientes as $cliente){
        $campoCliente[$cliente->id] =  $cliente->nome ;
    };
    // Estilos
    $campoClienteEstilo = "class='form-control'";
            
    echo form_dropdown('slcCliente',$campoCliente, $pedidos[0]->idClientes ,$campoClienteEstilo);
    
    //Campo produto
    echo form_label('','Produto');
    // Forma as opções
    $campoProduto[''] =  "Selecione o produto" ;
    foreach ($produtos as $produto){
        $campoProduto[$produto->id] =  $produto->descricao ;
    };
    // Extras
    $campoProdutoExtras = "class='form-control' onChange='AtualizaPreco(this.value)'";

    echo form_dropdown('slcProduto',$campoProduto, $pedidos[0]->idProdutos, $campoProdutoExtras);
    
    //Campo tipo hiden para preco do produto
    $campoPrecoProduto[''] =  "0.00" ;
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
        'value' => $pedidos[0]->valor,
        'placeholder' => 'Valor do pedido com dois decimais. Ex.1.99',
        'class' => 'form-control'
    );
    echo form_input($campoValor, set_value('numValor'));
    
    //Campo Status
    echo form_label('Status do pedido','Status');
    // Forma as opções
    $campoProduto =  array(
        '1' => 'Aberto',
        '2' => 'Pago',
        '3' => 'Cancelado'
        );
    
    // Extras
    $campoProdutoExtras = "class='form-control'";

    echo form_dropdown('slcStatus',$campoProduto, $pedidos[0]->status, $campoProdutoExtras);
    
    
    echo '<br><br>';
    
    // Botão submit
    $botaoSubmit = array(
        'class' => 'btn btn-primary'
    );
    echo form_submit('salvaEdita','Salvar',$botaoSubmit);
    
}
?>

<script>
// Atualiza preco
function AtualizaPreco(intIdProduto) {
    
    var indice = document.getElementsByName(intIdProduto);
    
    document.getElementById("numVal").value = indice[0].value;
        
    
}

</script>