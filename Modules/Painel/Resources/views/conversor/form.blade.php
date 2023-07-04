@extends('painel::layouts.master')

@section('content')
<div class="container">
  <!-- Content here -->
    <p style="margin-top:5%">
        <h1>Selecione a Moeda desejada para a conversão: </h1>   
    </p>
    <form>
    <div class="mb-3">
        <label for="moeda1" class="form-label">Moeda Origem/Destino:</label>
       
        <select class="form-select" id="moedas" aria-label="" required>
            <option selected value="BRL-USD">Real Brasileiro/Dólar Americano</option>
            <option value="BRL-EUR">Real Brasileiro/Euro</option>
            <option value="EUR-BRL">Euro/Real Brasileiro</option>
            <option value="EUR-USD">Euro/Dólar Americano</option>
            <option value="USD-BRL">Dólar Americano/Real Brasileiro</option>
            <option value="USD-EUR">Dólar Americano/Euro</option>
        </select>
       
    </div>

    <div class="mb-3">
        <label for="valor" class="form-label">Valor a ser Convertido:</label>
        <input type="text" class="form-control" id="valor" value="" aria-describedby="" required maxlength="10">
    </div>

    <div class="mb-3">
        <label for="valor" class="form-label">Forma Pagamento:</label>

        <select class="form-select" id="forma_pgto" aria-label="Forma de pagamento" required>
            @foreach($taxas as $value)
                <option value="{{$value['tipo']}}">{{$value['tipo']}}</option>
            @endforeach
        </select>
    </div>
    </form>
    <button type="button" class="btn btn-primary" onclick="submitForm();">Converter</button>
    <br>
    <br>
    <br>
    <div id="convertido"></div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function($){
        $('#valor').mask("#,##0.00", {reverse: true});
    });

    function submitForm() {

        let valor = $('#valor').val();
        let moedas = $('#moedas').val();
        let formaPgto = $('#forma_pgto').val();
        let html = "";
        var moedasSelecionadas = moedas.split('-');
        var moedaValor = valor.replace(',','');

        var dados = {
                        "moeda_origem": moedasSelecionadas[0],
                        "moeda_destino": moedasSelecionadas[1],
                        "valor": valor,
                        "forma_pgto": formaPgto,
                        "_token": "{{ csrf_token() }}"
                    };

        if(parseFloat(moedaValor) < 999 || parseFloat(moedaValor) > 100000){
            alert('O valor informado está incorreto!');
            throw new Error('O valor está incorreto!');
        }            

        $.post("{{url('')}}"+"/painel/conversor-moeda-painel",dados, function(data, status){
            html+= '<table class="table table-dark table-striped">';
            html+=    '<thead>';
            html+=        '<tr>';
            
            Object.keys(data).forEach(function(key) {
                html+=        '<th scope="col">'+key+'</th>';
            });
            
            html+=        '</tr>';
            html+=    '</thead>';
            html+=    '<tbody>';

            html+=        '<tr>';
            Object.keys(data).forEach(function(key) {
                html+=        '<th scope="row">'+data[key]+'</th>';
            });

            html+=        '</tr>';    
            html+=    '</tbody>';
            html+=    '</table>';
            document.getElementById("convertido").innerHTML = html;  
        });
    };

</script>
@endpush