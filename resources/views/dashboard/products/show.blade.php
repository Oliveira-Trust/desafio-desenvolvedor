@extends('layouts.dashboard.admin')
@section('title', 'Visualizar Produto')
@section('search-route', route('users.search'))

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{$product->name}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('products.index')}}" class="btn btn-primary btn-sm">Voltar</a>
        </div>
      </div>

      @if($message = Session::get('success'))
      <x-alert-success>
            {{$message}}
      </x-alert-success>
    @endif

      @if($message = Session::get('error'))
        <x-alert-danger>
              {{$message}}
        </x-alert-danger>
      @endif

      <div class="row d-flex justify-content-center align-content-center">
        <div class="card" style="width: 18rem;">
            @if($product->image !== null)
            <img src="{{env('APP_URL')}}/storage/{{$product->image}}" class="card-img-top" alt="...">
            @else
            <img src="https://via.placeholder.com/200" class="card-img-top" alt="...">
            @endif
            <div class="card-body">
            <h5 class="card-title"><strong>{{$product->name}}</strong></h5>
            <p class="card-text"><strong>{{$product->price}}</strong></p>
            <p class="card-text"><strong>{{$product->description}}</strong></p>
            </div>
          </div>
      </div>

@endsection

