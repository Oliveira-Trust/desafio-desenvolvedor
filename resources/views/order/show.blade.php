@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pedido número: #{{$order->id}}</div>

                    <div class="card-body">
                        @include('order.form')
                        <button class="btn btn-primary" onclick="window.history.back()">Voltar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


