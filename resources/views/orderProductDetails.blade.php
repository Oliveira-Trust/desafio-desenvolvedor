@extends('layouts.app')

@section('content')

    <div class="container">
        <a href="{{route('pedidos')}}" class="btn btn-success">Voltar</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Status</th>
                <th scope="col">Preço</th>
            </tr>
            </thead>
            <tbody>
        @foreach($fullOrder->products as $orderproduct)
            <tr>
                <th scope="row">{{$orderproduct->id}}</th>
                <td>{{$orderproduct->product->name}}</td>
                <td>{{$orderproduct->quantity}}</td>
                <td>{{$orderproduct->status}}</td>
                <td>{{$orderproduct->product->price}}</td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>
@endsection
