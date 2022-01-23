@extends('layouts.app')
@section('content')



<header>
    <ol>
        <li><a href="{{ route('User.index') }}">Usuário</a></li>
        <li class="active">{{ $Dados->name }}</li>
        <li class="active">Visualização</li>
    </ol>
</header>




{!! Form::model($Dados,['method' => 'PATCH', 'route'=>['User.update', $Dados->id]]) !!}

@include('User.Form')



<a class="btn btn-warning" href="{{ route("User.index") }}"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Voltar</a>
<button type="submit" name="myButton" value="foo" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Salvar</button>

{!! Form::close() !!}











@endsection
