@extends('masterpage')

@section('cabecalho')
    ERROS
@endsection

@section('body')
    <form method="get" action="{{route ('index')}}">
        <div>
            <h1> Motivo: </h1>
            <p>{{$message}} </p>
            <h1> Codigo: </h1>
            <p>{{$code}} </p>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Voltar</button>
    </form>
@endsection

