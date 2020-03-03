@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastro de produto</div>

                    <div class="card-body">
                        @if (!empty($savedReturn["success"]))
                            <div class="alert alert-success" role="alert">
                                {{ $savedReturn["success"] }}
                            </div>
                        @endif
                            <form method="post" action="{{route('produto.salvar')}}">
                                @csrf
                                <input type="hidden" name="productID" value="{{$product["id"]}}">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nome do Produto" required value="{{$product["name"]}}">
                                </div>
                                <div class="form-group">
                                    <label>Ean</label>
                                    <input type="text" name="ean" placeholder="Ean" class="form-control" required value="{{$product["ean"]}}">
                                </div>
                                <div class="form-group">
                                    <label>Preço</label>
                                    <input type="text" placeholder="Preço" name="price" class="form-control" required value="{{$product["price"]}}">
                                </div>
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <textarea type="text" name="description" class="form-control">
                                        {{$product["description"]}}
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
