@extends('layouts.dashboard.admin')
@section('title', 'Adicionar Pedido')

@section('content')
 <main>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Adicionar Pedido</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{route('orders.index')}}" class="btn btn-primary btn-sm">Voltar</a>
        </div>
    </div>
    <div class="card">

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('orders.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="products" class="col-md-4 col-form-label text-md-right">{{ __('Produtos') }}</label>

                    <div class="col-md-6">
                        <select id="products" class="form-control @error('products') is-invalid @enderror" name="products[]" required multiple>
                            @foreach($productList as $product)
                                <option value="{{$product->id}}">{{$product->name}} - {{$product->price}}</option>
                            @endforeach
                        </select>
                        @error('products')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Salvar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>


</main>
@endsection

