@extends('templates.template') <!--chamando o arquivo template que esta dentro da pasta templates!--->
@section('content')<!--chamando o conteudo de template!--->

    <h1 class="text-center">Visualizar</h1> <hr>

    <div class="col-8 m-auto">

        @php
            $user=$cadastro->find($cadastro->id)->relUsers;//Fazendo o relacionamento com tabela Users para pegar os seus campos de e-mail e Nome
        @endphp
        Nome: {{$user->name}}<br>
        Produto: {{$cadastro->produto}} <br>
        Id: {{$cadastro->id}}<br>
        Preço: R${{$cadastro->preço}}<br>
        E-mail: {{$user->email}}


    </div>

@endsection
