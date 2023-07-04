@extends('painel::layouts.master')

@section('content')
    <!-- <h1>Hello World !!!</h1>

    <p>
        This view is loaded from module: {!! config('painel.name') !!}
    </p> -->



<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Bem vindo, <strong>{{auth()->user()->name??""}}</strong></h1>
    <p class="lead">Fique a vontade para navegar no portal. <image src="{{ asset('images/conversor.png') }}" ></p> 
    <p>Utilize os menus acima para acessar as páginas... (autenticação realizada com sucesso!)</p>
    <p>Criador: <strong>Washington do Nascimento Monteiro - 07/2023 | E-mail: wasmont@gmail.com</strong></p>
  </div>
</main>

@endsection
