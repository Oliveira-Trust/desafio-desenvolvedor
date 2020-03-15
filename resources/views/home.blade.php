@extends('layouts.template')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">{{config('app.name')}}</h1>
    <p class="lead">Produtos de qualidade</p>
</div>

<div class="container">
    <form action="" class="row">
        <div class="col-md-9">
            <div class="form-group">
                <input type="search" name="search" id="search" class="form-control" placeholder="Procure aqui anúncio que deseja achar..." value="{{$search ? $search : ''}}">
            </div>
        </div>
        <div class="col-md-3">
            <input type="submit" value="Pesquisar" class="btn btn-md btn-success btn-block">
        </div>
    </form>

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-info mt-5 mb-5">Últimos Anúncios Adicionados!</h2>
        </div>
    </div>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-5">
                <div class="card">
                    <img height="200" src="{{ $product->photos()->first() ? asset('storage/products/' .  $product->photos()->first()->image) : asset('images/default.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->title}}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>R$ {{number_format($product->price, 2, ',', '.')}}</strong>
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="{{route('product.show', $product->id)}}" class="btn btn-md btn-primary btn-block">Visualizar</a>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-md-12 alert alert-warning">Desculpe, estamos em manutenção no momente, volte mais tarde!</div>
        @endforelse

    </div>
    <div class="row">
        <div class="text-center">{{$products->links()}}</div>
    </div>
</div>

<footer class="container-fluid bg-dark text-light text-center p-3">Desenvolvido por Carlos Eduardo</footer>
</div>
@endsection
