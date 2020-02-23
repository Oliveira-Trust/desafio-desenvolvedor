@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastro de Produto</div>
                    <div class="card-body">
                        <form method="post"
                              action="{{ $product?route('product.update',$product->id):route('product.store') }}">
                            @csrf
                            @if(isset($product))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" value="{{$product->name??''}}" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Preço</label>
                                <input type="text" value="{{$product->price??''}}" class="form-control" name="price">
                            </div>
                            <div class="form-group">
                                <label>Obs</label>
                                <input type="text" value="{{$product->obs??''}}" class="form-control" name="obs">
                            </div>
                            <br>
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

