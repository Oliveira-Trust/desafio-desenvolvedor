@extends('layouts.app')

@section('content')
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

    <div class="card">
        <div class="card-header">
            <h1>Edição de Pedido</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('purchases.update', $purchase->id)}}">
                @csrf @method('PATCH')
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">Cliente</label>
                        <select name="client_id" id="" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}"
                                @if ($client->id == $purchase->client->id)
                                    selected
                                @endif    
                                >{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Produto</label>
                        <select name="product_id" id="" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{$product->id}}"
                                @if ($product->id == $purchase->product->id)
                                    selected
                                @endif    
                                >{{$product->description}}</option>
                            @endforeach
                        </select>
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="phone">Quantidade</label>
                        <input type="text" name="quantity" class="form-control" id="quantity" value="{{$purchase->quantity}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="address">Status</label>
                        <select name="status" id="" class="form-control">
                            @foreach ($status as $type => $statusName)
                                <option value="{{$type}}"
                                @if ($type == $purchase->status)
                                    selected
                                @endif    
                                >{{$statusName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Atualizar</button>
                <a href="{{route('purchases.index')}}" class="btn btn-secondary">Voltar</a>
              </form>
        </div>
      </div>
      
@endsection