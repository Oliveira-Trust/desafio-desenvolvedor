@extends('home')
@section('card-header')
    Compras
@endsection
@section('main')
    <div class="col-sm-12 text-right">
        <button style="margin-bottom: 10px" class="btn btn-danger delete_all" data-url="{{route('purchase.destroy')}}">Excluir todos Selecionados</button>
        <a style="margin-bottom: 10px" class="btn btn-success" href="{{route('purchase.create')}}">Criar</a>
    </div>
    <table class="table table-bordered" id="table-purchase">
        <thead>
        <tr>
            <th><input type="checkbox" id="master"></th>
            <th>#</th>
            <th>Comprador</th>
            <th>Valor Total</th>
            <th>Total de Itens</th>
            <th width="100px">Ação</th>
        </tr>
        </thead>
        @if($purchases->count())
            <tbody>

            @foreach($purchases as $key => $purchase)
                <tr id="tr_{{$purchase->id}}">
                    <td><input type="checkbox" class="sub_chk" data-id="{{$purchase->id}}"></td>
                    <td>{{ $purchase->id }}</td>
                    <td><a href="{{route('user.show',$purchase->user->id)}}">{{ $purchase->user->name }}</a></td>
                    <td>R$ {{$purchase->totalValue()}}</td>
                    <td>{{$purchase->totalAmount()}}</td>
                    <td>
                        <a href="{{route('purchase.edit',$purchase->id)}}" class="btn btn-primary btn-sm"> Atualizar</a>
                        <a href="{{route('purchase.show',$purchase->id)}}" class="btn btn-success btn-sm"> Ver</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
@endsection

@section('js')
    <script src="{{ asset('js/deleteJs.js') }}" defer></script>
    <script src="{{ asset('js/table-purchase.js') }}" defer></script>

@endsection
