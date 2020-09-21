@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Produto {{$product->name}}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control" placeholder="Nome do Produto" value="{{$product->name}}"
                                   disabled="disabled">
                        </div>
                        <div class="form-group">
                            <label>Descricao</label>
                            <input type="text" name="description" placeholder="Descrição do produto" value="{{$product->description}}"
                                   disabled="disabled" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Preço</label>
                            <input type="number" name="price" placeholder="Preço do produto" class="form-control" value="{{$product->price}}"
                                   disabled="disabled">
                        </div>
                        <button class="btn btn-primary" onclick="window.history.back()">Voltar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


