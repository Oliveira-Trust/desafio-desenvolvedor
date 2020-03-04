@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if (!empty($success))
                        <div class="alert alert-success" role="alert">
                            {{ $success }}
                        </div>
                    @endif
                    <div class="card-header">Clientes</div>

                    <div class="card-body">
                        {{$clientGrid}}
                        <a class="btn btn-info" href="{{ route('cliente.cadastrar') }}">Novo</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
