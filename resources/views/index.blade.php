@extends('templates.template') <!--chamando o arquivo template que esta dentro da pasta templates!--->
@section('content')<!--chamando o conteudo de template!--->

<h1 class="text-center">Cadastros de pedidos de compra</h1>
<hr>

<div class="text-center mt-3 mb-4">
    <a href="{{url('cadastro/create')}}">
        <button class="btn btn-success">Cadastrar</button>
    </a>
</div>

<div class="col-8 m-auto">
    @csrf
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Produto</th>
            <th scope="col">Preço</th>
            <th scope="col"></th>


        </tr>
        </thead>
        <tbody>

                    @foreach($cadastro as $cadastros)

                        @php
                            $user=$cadastros->find($cadastros->id)->relUsers;//Fazendo o relacionamento com id para pegar os nomes
                        @endphp
                        <tr>
                            <th scope="row">{{$cadastros->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$cadastros->produto}}</td>
                            <td>{{$cadastros->preço}}</td>
                            <td>
                                <a href="{{url("cadastro/$cadastros->id")}}"><!--Rota para visualizar o status!-->
                                    <button class="btn btn-primary">Visualizar</button>
                                </a>

                                <a href="{{url("cadastro/$cadastros->id/edit")}}">
                                    <button class="btn btn-light">Editar</button>
                                </a>


                                <a href="{{route('excluir_cadastro', ['id'=>$cadastros->id])}}">
                                    @method('DELETE')
                                    <button class="btn btn-danger">Deletar</button>
                                </a>


                            </td>

                        </tr>
                    @endforeach


        </tbody>
    </table>
</div>
@endsection
