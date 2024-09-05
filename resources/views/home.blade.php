@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Introdução') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-4">
                        <h2>Seja bem-vindo(a), {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h2>
                    </div>
                    <div>
                        <a class="btn btn-dark" href="{{ route('cambio.index') }}">Iniciar Sistema</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
