@extends('layouts.app')

@section('content')
    <div class="container">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                {{ \Session::get('success') }}
            </div>
        @endif
            @if (\Session::has('errors'))
                <div class="alert alert-danger">
                    {{ \Session::get('errors') }}
                </div>
            @endif
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

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
