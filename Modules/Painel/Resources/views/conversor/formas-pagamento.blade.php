@extends('painel::layouts.master')

@section('content')
<div class="container">
  <!-- Content here -->
    <p style="margin-top:5%">
        <h1>Modificar formas de pagamento: </h1>   
    </p>
    <form method="POST">
        <div class="mb-3">
            <label for="valor" class="form-label">Forma de Pagamento:</label>
            <input type="text" class="form-control" id="formaPgto" value="" aria-describedby="" required maxlength="150">
        </div>
        <div class="mb-3">
            <label for="valor" class="form-label">Valor:</label>
            <input type="text" class="form-control" id="valor" value="" aria-describedby="" required maxlength="11">
        </div>
    </form>
    <button type="button" class="btn btn-primary" onclick="submitForm();">Adicionar</button>

    <br>
    <br>
    <br>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tipo de Pagamento</th>
                <th scope="col">Taxa</th>
                <th scope="col">Criado</th>
                <th scope="col">Última Alteração</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>

            @foreach($taxas as $item)
                <tr>
                    <th scope="row">{{$item['id']}}</th>
                    <th scope="row">{{$item['tipo']}}</th>
                    <th scope="row"><input type = "text" value="{{$item['valor']}}" onkeypress="modificar(event,this);" data-pk="{{$item['id']}}" title="Tecle enter para alterar"></th>
                    <th scope="row">{{(!empty($item['created_at']))?date_format($item['created_at'], 'd/m/Y H:i:s'):''}}</th>
                    <th scope="row">{{(!empty($item['updated_at']))?date_format($item['updated_at'], 'd/m/Y H:i:s'):''}}</th>
                    <th scope="row"><a href="#" data-pk="{{$item['id']}}" onclick="excluir(event,this);">Excluir</a></th>
                </tr>
            @endforeach

        </tbody>
    </table>

    {!! $taxas->withQueryString()->links('pagination::bootstrap-5') !!}

</div>
@endsection

@push('scripts')
<script type="text/javascript">

    function modificar(e,input) {
        if (e.key === "Enter") {
            dados={"valor":input.value, "id":input.dataset.pk, "_token": "{{ csrf_token() }}"};    
            $.post("{{url('')}}"+"/painel/modificar-taxas",dados, function(data, status){
                if(data)
                    location.reload();
                    //alert('Modificado com sucesso!');
            });

        };
    }

    $(document).ready(function($){
        $('#valor').mask("#,##0.00", {reverse: true});
    });

    function excluir(e,input){
        $.post("{{url('')}}"+"/painel/remover-taxa",{"id":input.dataset.pk, "_token": "{{ csrf_token() }}"}, function(data, status){
            if(data)
                document.location.reload(true);
        });
    }

    function submitForm(){
        let formaP = $('#formaPgto').val();
        let valor = $('#valor').val();
        var moedaValor = valor.replace(',','');
        
        $.post("{{url('')}}"+"/painel/adicionar-taxa",{"tipo":formaP, "valor":moedaValor, "_token": "{{ csrf_token() }}"}, function(data, status){
            if(data)
                document.location.reload(true);
        });
    }

</script>
@endpush