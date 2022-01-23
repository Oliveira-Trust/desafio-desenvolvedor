@extends('layouts.app')
@section('content')



<header>
    <ol>
        <li><a href="{{ route('User.index') }}">Usuário</a></li>
        <li class="active">{{ $Dados->name }}</li>
        <li class="active">Visualização</li>
    </ol>
</header>




{!! Form::model($Dados,['method' => 'PATCH', 'class' => 'FormDisable', 'route'=>['User.update', $Dados->id]]) !!}

@include('User.Form')




{!! Form::close() !!}






{!! Form::model($Dados,['method' => 'delete','route'=>['User.destroy', $Dados->id]]) !!}
<a class="btn btn-warning" href="{{ route("User.index") }}"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Voltar</a>
<a class="btn btn-primary text-white" href="{{ route("User.edit", $Dados->id) }}"><i class="fa fa-edit" aria-hidden="true"></i> Editar</a>

<button type="submit" name="myButton" value="foo" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Deletar</button>

{!! Form::close() !!}





@endsection
