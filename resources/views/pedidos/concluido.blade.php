@extends('welcome')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

    
<script type="text/javascript">
 $(function() {
 $('#concluido').modal();
   
    
   
  })

</script>
<div class="modal fade" id="concluido" tabindex="-1" role="dialog" aria-labelledby="concluido" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="concluidoModalLabel">Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="window.location='{{ url("/pedidos") }}'">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Pedido Inserido/Editado com sucesso!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location='{{ url("/pedidos") }}'">Fechar</button>
      </div>
    </div>
  </div>
</div>
@endsection
