@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Produto {{$product->name}}</div>

                    <div class="card-body">
                        <form method="post" action="{{route('products.update', ["product" => $product])}}">
                            @method('PATCH')
                            @include('product.form')
                            <button type="submit" class="btn btn-primary">Editar Produto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


