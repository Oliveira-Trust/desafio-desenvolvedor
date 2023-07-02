@extends('painel::layouts.master')

@section('content')
<div class="container">
  <!-- Content here -->
    <p style="margin-top:5%">
        <h1>Listagem de Conversões: (Históricos)</h1>   
        <a href="#" id="print" onclick="imprimir()">Imprimir</a>
    </p>

    <!-- < ?php  echo'<pre>';print_r($itens[0]['payload']);die;?> -->
    <div id='printarea'>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Moeda de origem</th>
                <th scope="col">Moeda de destino</th>
                <th scope="col">Valor para conversão</th>
                <th scope="col">Forma de pagamento</th>
                <th scope="col">Valor da "Moeda de destino" usado para conversão</th>
                <th scope="col">Valor comprado em "Moeda de destino"</th>
                <th scope="col">Taxa de pagamento</th>
                <th scope="col">Taxa de conversão</th>
                <th scope="col">Valor utilizado para conversão descontando as taxas</th>
                <th scope="col">Criado</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($itens as $item)
                <tr>
                    <th scope="row">{{$item['id']}}</th>
                @foreach (json_decode($item['payload']) as $key=>$value)
                    <td>{{ $value }}</td>
                @endforeach
                    <th scope="row">{{date_format($item['created_at'], 'd/m/Y H:i:s')}}</th>
                </tr>
            @endforeach

        </tbody>
    </table>
    
    {!! $itens->withQueryString()->links('pagination::bootstrap-5') !!}

    </div>

</div>
@endsection
<script>
    function imprimir(){
        var printContents = document.getElementById("printarea").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    };
</script>
