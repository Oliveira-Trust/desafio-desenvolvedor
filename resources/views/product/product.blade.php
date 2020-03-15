@extends('layouts.template')

@section('title', 'Produto')

@section('content')

    <div class="container p-5">

        @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    @forelse($product->photos as $photo)
                        <div class="col-md-6 p-3">
                            <img src="{{asset('storage/products/' . $photo->image )}}" alt="[ FOTO DO ANÚNCIO ]" class="img-thumbnail">
                        </div>
                    @empty
                        <div class="col-md-12 p-3">
                            <img src="{{asset('images/default.png')}}" alt="[ ANÚNCIO SEM FOTO ]" class="img-thumbnail">
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="col-md-6">
                <h3>{{$product->title}}</h3>
                <hr>
                <div class="card-body">
                    <p>{{$product->description}}</p>
                </div>
                <h4 class="alert">R$ {{number_format($product->price, 2, ',', '.')}}</h4>

                <form action="{{route('cart.add')}}" method="post">
                    @csrf

                    <input type="hidden" name="product[id]" value="{{$product->id}}">
                    <input type="hidden" name="product[title]" value="{{$product->title}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <label for="qtd" class="col-form-label font-weight-bold">QTD</label>
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="qtd" name="product[qtd]" class="form-control" value="1">
                            </div>
                            @if($product->user_id != Auth::user()->id)
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-xd btn-primary btn-block" id="purpose">Comprar</button>
                                </div>
                            @endif
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
