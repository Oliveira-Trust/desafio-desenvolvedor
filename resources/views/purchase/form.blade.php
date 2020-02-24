@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastro de Pedido</div>
                    <div class="card-body">
                        <form method="post"
                              action="{{ isset($purchase)?route('purchase.update',$purchase->id):route('purchase.store') }}">
                            @csrf
                            @if(isset($purchase))
                                @method('PUT')
                            @endif
                            <h4>Escolha as quantidades dos produtos abaixo:</h4>
                            @foreach($products as $product)
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="{{'qtd_' . $product->id}}">{{$product->name}}</label>
                                        <p class="form-control-plaintext">
                                            R$ {{number_format($product->price,2,',','')}}</p>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Qtd</label>
                                        <input type="number" name="qtd[{{$product->id}}]" id="{{'qtd_' . $product->id}}"
                                               value="{{$product->qtd}}" class="form-control" min="1" max="10">
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

