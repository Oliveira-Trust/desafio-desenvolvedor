@extends('layouts.app')
@section('content')



<header>
    <ol>
        <li><a href="{{ route('CurrencyConversion.index') }}">Conversão</a></li>
        <li class="active">{{ $Dados->user->name }}</li>
        <li class="active">Visualização</li>
    </ol>
</header>




{!! Form::model($Dados,['method' => 'PATCH', 'route'=>['CurrencyConversion.update', $Dados->id]]) !!}

@include('CurrencyConversion.Form')



<a class="btn btn-warning" href="{{ route("CurrencyConversion.index") }}"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Voltar</a>
<button type="submit" name="myButton" value="foo" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Salvar</button>

{!! Form::close() !!}











@endsection
