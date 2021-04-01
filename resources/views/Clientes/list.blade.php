@extends('welcome')

@section('content')
 
<div class="container">
  <main>
  
    <div class="row g-12">
      
      <div class="col-md-12 col-lg-12">
        <h4 class="mb-3">Listar Produtos</h4>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css" rel="stylesheet"/>

   <script>
  var $table = $('#table')

  $(function() {
   $( "#delete" ).click(function() {
   if(confirm("Deseja Realmente Deletar os registros selecionados ?"))
   {
      var deletar =  $('form').serializeArray();
              jQuery.each( deletar, function( i, field ) {
                                             if(field.name == "id" )
                                                {
                                               		$.get('clientes/deletar/'+field.value, '', function (data, textStatus, jqXHR) {});
                                                }
    	});
    alert('Deletado');
    location.reload();
      return false
      }
    })
    
   
  })
</script> 
<form>
<button class="btn btn-primary" id="delete">Delete</button>
<table id="table" data-toggle="table"  data-search="true" data-pagination="true" data-click-to-select="true"
    data-id-field="id"
    data-select-item-name="id">
   <thead>
            <tr>
            	<th data-field="state" data-checkbox="true"></th>
            	<th data-order='desc' data-field="id" data-sortable="true">Id Cliente</th>
                <th data-order='desc' data-field="nome_cliente" data-sortable="true">Nome Cliente</th>
                <th data-order='desc' data-field="cnpj" data-sortable="true">CNPJ</th>
                <th data-order='desc' data-field="endereco" data-sortable="true">Endereco</th>
                <th data-order='desc' data-field="cep" data-sortable="true">CEP</th>
                <th data-order='desc' data-field="uf" data-sortable="true">UF</th>
                <th data-order='desc' data-field="Editar" data-sortable="false">Acoes</th>
            </tr>
    </thead>
     <tbody>
     @foreach($clientes as $class)
        <tr>
        <td></td>
        <td>{{$class->id}}</td>
        <td>{{$class->nome_cliente}}</td> 
        <td>{{$class->cnpj}}</td>
        <td>{{$class->endereco}}</td>
        <td>{{$class->cep}}</td>
        <td>{{$class->uf}}</td>
        <td>
        <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/clientes/editar",['id'=>$class->id]) }}'">Editar</button>
        <button type="button" class="btn btn-primary" onclick="if(confirm('Deseja Realmente Deletar os registros selecionados ?')) window.location='{{ url("/clientes/deletar",['id'=>$class->id]) }}'">Deletar</button>
        </td>
        </tr>
             @endforeach
    </tbody>
</table>
</form>
        
                 
              
                    
                
           

      </div>
    </div>
  </main>

 
</div>

@endsection

