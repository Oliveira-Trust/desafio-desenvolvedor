@extends('layouts.dashboard.admin')
@section('title', 'Lista de Produtos')
@section('search-route', route('products.search'))

@section('content')
 <main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Produtos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('products.create')}}" class="btn btn-primary btn-sm">Adicionar</a>
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

     @if(count($productList) < 1)
        <div class="alert alert-dark" role="alert">
            Não foram encontrados produtos cadastrados!
        </div>
     @else
        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productList as $key => $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td><img src="{{env('APP_URL')}}/storage/{{$product->image}}"class="img-fluid img-thumbnail" width="100" height="100" loading="lazy"></td>
                    <td>
                        <a class="btn btn-sm btn-light" href="{{route('products.show',[$product->id])}}">Visualizar</a>
                        <a class="btn btn-sm btn-warning" href="{{route('products.edit',[$product->id])}}">Editar</a>
                        <a class="btn btn-sm btn-danger" href="{{route('products.destroy',['id'=>$product->id])}}" >Apagar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            @if($productList->contains('links'))
            {{$productList->links()}}
            @endif()
        </div>
    @endif
</main>
@endsection

