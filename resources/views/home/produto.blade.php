@extends('layout')
@section('pagina_titulo', $registro->nome )

@section('pagina_conteudo')

<div class="container">
    <div class="row">
        <h3>{{ $registro->nome }}</h3>
        <div class="divider"></div>
        <div class="section col s12 m12 l12">
            <div class="section col s12 m12 l12">
                {!! $registro->descricao !!}
            </div>
            <h4 class="left col l12"> R$ {{ number_format($registro->valor, 2, ',', '.') }} </h4>
        </div>
        <form method="POST" action="{{ route('carrinho.adicionar') }}">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $registro->id }}">
            <button style="margin-left: 22px;" class="btn-large col l6 m6 s6 red accent-4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="O Produto Será Adicionado ao Seu Carrinho">Comprar</button>
        </form>
    </div>
</div>
@endsection