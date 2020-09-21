@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Pedidos</div>

                    <div class="col-12" style="margin-left: 15px; margin-top: 15px">
                        <p><a href="{{ route('orders.create') }}">Novo Pedido</a></p>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nome do Produto</th>
                                <th>Quantidade</th>
                                <th>Status</th>
                                <th>Preço</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{ route('orders.show', ['order' => $order]) }}">{{$order->product->name}}</a></td>
                                    <td> {{$order->quantity}} </td>
                                    <td> {{$order->status}} </td>
                                    <td> {{$order->product->price}} </td>
                                    <td>
                                        <div class="row">
                                            <button class="btn btn-info"><a href="{{ route('orders.edit', ['order' => $order]) }}">editar</a></button>
                                            <form action="{{ route('orders.destroy', ['order' => $order]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


