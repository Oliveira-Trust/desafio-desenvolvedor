@extends('layouts.app')

@section('content')

<div class="card-header">{{ __('Dashboard') }}</div>

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="m-t-30">
{{ __('Parabéns, você está acessando um sistema do desafio da Oliveira Trust!') }}
</div>

@endsection
