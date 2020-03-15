@extends('layouts.template')

@section('title', 'Produtos')

@section('content')

    <div class="container p-5">

        <div class="row">
            <div class="col-md-2">

                <h3>Filtrar</h3>

                <hr>

                <form action="{{route('product.products')}}" method="get">
                    <div class="group">
                        <label for="title">Titulo</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>

                    <div class="group">
                        <label for="price-initial">Valor Inicial</label>
                        <input type="text" name="price_initial" id="price-initial" class="form-control">
                    </div>

                    <div class="group">
                        <label for="price-end">Valor Final</label>
                        <input type="text" name="price_end" id="price-end" class="form-control">
                    </div>

                    <div class="group">
                        <label for="order">Order por:</label>
                        <select name="order" id="order" class="form-control">
                            <option value="title">Título</option>
                            <option value="price">Valor</option>
                        </select>

                        <select name="order2" id="order2" class="form-control mt-1">
                            <option value="asc">Crescente</option>
                            <option value="desc">Decrescente</option>

                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-md btn-primary btn-block">Filtrar</button>
                    </div>

                </form>
            </div>
            <div class="col-md-9">

                <div class="row">
                @forelse($products as $product)
                    <div class="card col-md-3 m-3">
                        <img height="200" src="{{ $product->photos()->first() ? asset('storage/products/' .  $product->photos()->first()->image) : asset('images/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->title}}</h5>
                            <strong>R$ {{number_format($product->price, 2, ',', '.')}}</strong>
                            <a href="{{route('product.show', $product->id)}}" class="btn btn-md btn-primary btn-block">Visualizar</a>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 alert alert-warning">Desculpe, estamos em manutenção no momente, volte mais tarde!</div>
                @endforelse
                </div>

            </div>
        </div>

    </div>

@endsection
