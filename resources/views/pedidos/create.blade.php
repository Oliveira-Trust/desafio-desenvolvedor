@extends('welcome')

@section('content')
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
<div class="container">
  <main>
  
    <div class="row g-12">
      
      <div class="col-md-12 col-lg-12">
      
        <h4 class="mb-3">Selecione o Cliente</h4>


        <form action="{{ route('salva_pedido')}}" method="POST">
       @csrf
         

   <div class="col-sm-12">  
<table id="table" data-toggle="table"  data-search="true" data-pagination="true" data-click-to-select="true"
    data-id-field="id_cliente"
    data-select-item-name="id_cliente">
   <thead>
            <tr>
            	<th data-field="state" data-radio="true"></th>
            	<th data-order='desc' data-field="id_cliente" data-sortable="true">Id Cliente</th>
                <th data-order='desc' data-field="nome_cliente" data-sortable="true">Nome Cliente</th>
                <th data-order='desc' data-field="cnpj" data-sortable="true">CNPJ</th>
                <th data-order='desc' data-field="endereco" data-sortable="true">Endereco</th>
                <th data-order='desc' data-field="cep" data-sortable="true">CEP</th>
                <th data-order='desc' data-field="uf" data-sortable="true">UF</th>
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
        
        </tr>
             @endforeach
    </tbody>
</table>
          <hr class="my-4">

 <button class="btn btn-primary btn-lg" type="submit">Prosseguir</button>
          
          </div>
         
        </form>
      </div>
    </div>
  </main>

 
</div>

@endsection
