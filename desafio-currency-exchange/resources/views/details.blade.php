@extends('masterpage')

@section('cabecalho')
    Resultado
@endsection

@section('body')
    <form method="get" action="{{route ('index')}}">
        <div style="background-color: floralwhite">
            <h3>Moeda de origem: </h3>
            <p style="color: darkblue">{{$response['codein']}} </p>
            <h3>Moeda de destino: </h3>
            <p style="color: darkblue">{{$response['code']}} </p>
            <h3>Valor para conversão: </h3>
            <p style="color: darkblue">R$ {{$response['value_exchange']}} </p>
            <h3>Forma de pagamento: </h3>
            <p style="color: darkblue">{{$response['type_payment']}} </p>
            <h3>Valor da "Moeda de destino" usado para conversão: </h3>
            <p style="color: darkblue">R$ {{$response['bid']}} </p>
            <h3>Valor comprado em "Moeda de destino": </h3>
            <p style="color: darkblue">{{$response['value_currecy_exchange']}} </p>
            <h3>Taxa de pagamento:</h3>
            <p style="color: darkblue">R$ {{$response['rate_payment']}} </p>
            <h3>Taxa de conversão:</h3>
            <p style="color: darkblue">R$ {{$response['rate_value']}} </p>
            <h3>Valor utilizado para conversão descontando as taxas: </h3>
            <p style="color: darkblue">R$ {{$response['final_value']}} </p>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Voltar</button>
    </form>

@endsection


