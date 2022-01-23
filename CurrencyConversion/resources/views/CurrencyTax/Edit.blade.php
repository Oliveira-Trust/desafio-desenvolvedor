@extends('layouts.app')
@section('content')



<header>
    <ol>
        <li class="active">Configuração das Taxas</li>
    </ol>
</header>




{!! Form::model($Dados,['method' => 'PATCH', 'route'=>['CurrencyTax.update', $Dados->id]]) !!}

@include('CurrencyTax.Form')



<button type="submit" name="myButton" value="foo" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Salvar</button>

{!! Form::close() !!}



@endsection
