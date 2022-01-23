@extends('layouts.app')
@section('content')


<header>
    <ol>
        <li><a href="{{ route('CurrencyConversion.index') }}">Conversão</a></li>
        <li class="active">{{ $Dados->user->name }}</li>
        <li class="active">Visualização</li>
    </ol>
</header>



<div class="table-responsive-sm">

    <table class="table table-striped ">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td class="text-end">Data</td>
                <td class="fw-bold">{{$Dados->created_at}}</td>

            </tr>
            <tr>
                <td class="text-end">Destino</td>
                <td class="fw-bold">{{$Dados->Currency->abbreviation}}</td>
            </tr>
            <tr>
                <td class="text-end">Valor</td>
                <td class="fw-bold">{{$Dados->origin_value}}</td>
            </tr>
            <tr>
                <td class="text-end">Forma de Pagamento</td>
                <td class="fw-bold">{{$Dados->payment_method}}</td>
            </tr>
            <tr>
                <td class="text-end">Cotação</td>
                <td class="fw-bold">{{$Dados->tax_currency}}</td>
            </tr>
            <tr>
                <td class="text-end">Taxa De Pagamento</td>
                <td class="fw-bold">{{$Dados->tax_payment_method}}</td>
            </tr>
            <tr>
                <td class="text-end">Taxa De Conversão</td>
                <td class="fw-bold">{{$Dados->tax_conversion}}</td>
            </tr>
            <tr>
                <td class="text-end">Valor Com Desconto</td>
                <td class="fw-bold">{{$Dados->updated_value}}</td>
            </tr>
            <tr>
                <td class="text-end">Valor Comprado</td>
                <td class="fw-bold">{{$Dados->converted_value}}</td>
            </tr>
            <tr>
                <td class="text-end">Usuário</td>
                <td class="fw-bold">{{$Dados->User->name}}</td>
            </tr>
        </tbody>
    </table>
</div>

{!! Form::model($Dados,['method' => 'delete','route'=>['CurrencyConversion.destroy', $Dados->id]]) !!}
<a class="btn btn-warning" href="{{ route("CurrencyConversion.index") }}"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Voltar</a>
<a class="btn btn-primary text-white" href="{{ route("CurrencyConversion.edit", $Dados->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Editar</a>

<button type="submit" name="myButton" value="foo" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Deletar</button>

{!! Form::close() !!}



@endsection
