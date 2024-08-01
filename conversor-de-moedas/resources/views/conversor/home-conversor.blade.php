@extends('layouts.layout')

@section('title', 'Conversão de moeda BRL')

@section('content')
<div class="conversor-container">
    <h2 class="mb-5">Bem-vindo ao sistema de conversão de moeda BRL</h2>
    <form id="conversor-form" action="/conversor" method="GET" class="form-conversor">
        <button type="submit" class="btn btn-conversor">
            Realizar conversão
        </button>
        <img src="{{ asset('assets/icons/icon-seta.svg') }}" alt="Ícone de seta" class="seta" onclick="document.getElementById('conversor-form').submit();">
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.querySelector('.seta').addEventListener('click', function() {
        document.getElementById('conversor-form').submit();
    });
</script>
@endsection
