@extends('layouts.app')
@section('content')



<header>
    <ol>
        <li class="active">Configuração das Taxas</li>
    </ol>
</header>




{!! Form::model($Dados,['method' => 'PATCH', 'class' => 'FormDisable', 'route'=>['CurrencyTax.update', $Dados->id]]) !!}

@include('CurrencyTax.Form')



<a class="btn btn-primary text-white" href="{{ route("CurrencyTax.edit", $Dados->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Editar</a>


{!! Form::close() !!}


@endsection
