@extends('welcome')

@section('content')
  
<div class="container">
  <main>
  
    <div class="row g-12">
      
      <div class="col-md-12 col-lg-12">
      
        <h4 class="mb-3">Itens do Pedido </h4>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		  	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>
		   <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css" rel="stylesheet"/>

   


        
          <div class="row g-12">
            <div class="col-sm-12">
            <h4 class="mb-4">Informacoes do Cliente</h4>
            <div class="row g-12">
            
                        <div class="col-sm-3">
                         Nome Cliente: {{$cliente[0]->nome_cliente}}
                        </div>
                         <div class="col-sm-3">
                         CNPJ: {{$cliente[0]->cnpj}}
                        </div>
                        <div class="col-sm-3">
                         UF: {{$cliente[0]->uf}}
                        </div>
                        <div class="col-sm-3">
                         CEP: {{$cliente[0]->cep}}
                        </div>
                        <div class="col-sm-3">
                         Endereco: {{$cliente[0]->endereco}}
                        </div>
            </div>
            </div>
<form action="{{ route('salva_itens')}}" method="POST">
       @csrf
       <input type="hidden" id="id_pedido" name="id_pedido" value="{{$pedido->id}}">
   <div class="col-sm-12">  
   <hr class="my-4">     
            <table id="table" data-toggle="table"  data-search="false" data-pagination="false" data-click-to-select="true" 
                data-id-field="id"
                data-select-item-name="id">
               <thead>
                        <tr>
                            <th data-order='desc' data-field="id">Produto ID</th>
                            <th data-order='desc' data-field="name">Nome Produto</th>
                            <th data-order='desc' data-field="custo">Pre&ccedil;o Produto</th>
                            <th data-order='desc' data-field="estoque">Estoque</th>
                            <th data-order='desc' data-field="quantidade">Quantidade Pedido</th>
                            <th data-order='desc' data-field="desconto">Desconto%</th>
                            <th data-order='desc' data-field="total_item">Total Item</th>
                        </tr>
                </thead>
                 <tbody>
                 @foreach($produto as $class)
                    <tr>
                    <td>{{$class->id}}<input type="hidden" id="id_item[{{$class->id}}]" name="id_item[{{$class->id}}]" value="{{$class->id}}"></td>
                    <td>{{$class->nome_produto}}</td> 
                    <td>R$ {{number_format($class->valor_produto, 2, ",", ".")}}</td>
                    <td>{{$class->quantidade_estoque}}</td>
                    <td> <input type="text" class="form-control" id="qtd_item[{{$class->id}}]" name="qtd_item[{{$class->id}}]" onblur="JS:total_item('{{$class->id}}','{{$class->valor_produto}}')" > </td>
                    <td> <input type="text" class="form-control" id="desconto_item[{{$class->id}}]" name="desconto_item[{{$class->id}}]" onblur="JS:total_item('{{$class->id}}','{{$class->valor_produto}}')"> </td>
                    <td>
                    <input type="text" id="total_item[{{$class->id}}]" class="form-control"   name="total_item[{{$class->id}}]"  readonly>
                    <input type="hidden" id="valor_item[{{$class->id}}]" name="valor_item[{{$class->id}}]" value="{{$class->valor_produto}}" ></td>
                    </tr>
                 @endforeach
                </tbody>
                <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th colspan="2"><div id="total_pedido"></div></th>
                        </tr>
                </tfoot>
            </table>
          <hr class="my-4">


          <button class="btn btn-primary btn-lg" type="submit">Inserir Pedido</button>
          </div>
        </form>
      </div>
    </div>
  </main>

 
</div>
   <script>
   
  var $table = $('#table');
  function total_item(id,valor_item)
  {

  var val_total_pedido = 0;
  var desconto_item = document.getElementById("desconto_item["+id+"]").value;
  if(desconto_item >0) { desconto_item = (desconto_item/100);} else {desconto_item=0};
  
  var qtd_item = +(document.getElementById("qtd_item["+id+"]").value);

  if(desconto_item >0)
  	var valor_tota_item = (qtd_item*valor_item)-((qtd_item*valor_item)*desconto_item);
  	else
  	var valor_tota_item = (qtd_item*valor_item);
  
		document.getElementById("total_item["+id+"]").value = valor_tota_item;
  			  var total_pedido_var =  $('form').serializeArray();
              jQuery.each( total_pedido_var, function( i, field ) {
                                             if(field.name.substring(0,10) == "total_item" )
                                                { 
                                                    if(field.value)
                                                   		val_total_pedido = parseFloat(val_total_pedido) + parseFloat(field.value);
                                                }
    	});
    	$( "#total_pedido").html("Total Pedido : R$ "+val_total_pedido.toFixed(3).toString().replace(".", ","));
  }
</script> 
@endsection
