@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cliente {{$client->name}}</div>

                    <div class="card-body">
                        @include('client.form')
                        <button class="btn btn-primary" onclick="window.history.back()">Voltar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


