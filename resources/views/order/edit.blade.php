@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pedido número: #{{$order->id}}</div>

                    <div class="card-body">
                        <form method="post" action="{{route('orders.update', ["order" => $order])}}">
                            @method('PATCH')
                            @include('order.form')
                            <button type="submit" class="btn btn-primary">Editar pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


