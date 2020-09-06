@extends('layouts.dashboard.admin')

@section('title', 'Dashboard')

@section('content')


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">{{ __('Dashboard') }}</h1>

    </div>
        <div>
            <h1>Olá {{ Auth::user()->name }}, bem vindo ao painel de controle !</h1>

        </div>



@endsection
