@extends('home')
@section('card-header')
    Usuários
@endsection
@section('main')
    <div class="col-sm-12 text-left">
        <a >Nome do comprador: <a href="{{route('user.show',$purchase->user->id)}}">{{$purchase->user->name}}</a></a><br>
        <a>Data: {{\Carbon\Carbon::parse($purchase->created_at)->format('d/M/Y')}}</a><br>
        <a>Valor Total: {{$purchase->totalValue()}}</a><br>
        <div class="col-sm-12 text-right">
            <a style="margin-bottom: 10px" class="btn btn-success" href="{{route('purchase.edit',$purchase->id)}}">Editar</a>
        </div>
    </div>
    <table id="show-purchase" class="table table-bordered">
        <thead>
        <tr>
            <th># do produto</th>
            <th>Nome do produto</th>
            <th>Valor</th>
            <th>Quantidade</th>

        </tr>
        </thead>
        @if($purchase)
            <tbody>
            @foreach($purchase->products as $key => $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>R$ {{$product->price}}</td>
                    <td>{{$product->pivot->amount}}</td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
@endsection
@section('js')
    <script src="{{ asset('js/purchase-show.js') }}" defer></script>
@endsection

