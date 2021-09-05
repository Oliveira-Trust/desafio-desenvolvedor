@extends('home')
@section('card-header')
    Usuários
@endsection
@section('main')
    <div class="col-sm-12 text-left">
        <a>Nome: {{$user->name}}</a><br>
        <a>Cadastro: {{\Carbon\Carbon::parse($user->created_at)->format('d/M/Y')}}</a><br>
        <a>Compras</a>

    </div>
    <table id="show-user" class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Valor</th>
            <th>Itens</th>
            <th>Data</th>
            <th width="100px">Ação</th>
        </tr>
        </thead>
        @if($user->purchases->count())
            <tbody>

            @foreach($user->purchases as $key => $purchase)
                <tr>
                    <td>{{$purchase->id}}</td>
                    <td>R$ {{$purchase->totalValue()}}</td>
                    <td>{{$purchase->totalAmount()}}</td>
                    <td>{{\Carbon\Carbon::parse($purchase->created_at)->format('d/M/Y')}}</td>
                    <td> <a href="{{route('purchase.show',$purchase->id)}}" class="btn btn-primary btn-sm"> Ver</a></td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
@endsection

@section('js')
    <script src="{{ asset('js/user-show.js') }}" defer></script>
@endsection
