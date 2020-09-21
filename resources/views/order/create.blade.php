@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Novo Pedido</div>

                    <div class="card-body">
                        <form method="post" action="{{route('orders.store')}}">
                            @include('order.form')
                            <button type="submit" class="btn btn-primary">Realizar pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


