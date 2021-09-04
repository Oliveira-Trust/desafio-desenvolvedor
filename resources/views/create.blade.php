@extends('templates.template') <!--chamando o arquivo template que esta dentro da pasta templates!--->
@section('content')<!--chamando o conteudo de template!--->

<h1 class="text-center">@if(isset($cadastro))Editar @else Cadastrar @endif</h1>

<div class="text-center "></div>

<div class="col-8 m-auto">

    @if(isset($cadastro))
        <form name="Editar" id="Editar" action="{{url("cadastro/$cadastro->id")}}" method="post">
            @method('PUT')
    @else
                <form name="Cadastro" id="Cadastro" action="{{url("cadastro")}}" method="post">
    @endif
        @csrf

        <select name="id_user" id="id_user" class="form-control" >
            <option value="{{$cadastro->relUsers->id ?? ''}}">{{$cadastro->relUsers->name ?? 'Nome'}}</option><!--Pegando o nome para deixar fixo no input!-->
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option><br>

            @endforeach
        </select><br>
        <input class="form-control" type="text" name="produto" id="produto" placeholder="Produto" value="{{$cadastro->produto ?? ''}}" required><br>
        <input class="form-control" type="text" name="preço" id="preço" placeholder="Preço" value="{{$cadastro->preço ?? ''}}" required><br>
        <input class="btn btn-primary" type="submit" value="@if(isset($cadastro))Editar @else Cadastrar @endif" >

    </form>
</div>

@endsection
