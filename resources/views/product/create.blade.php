@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastrar Produto</div>

                    <div class="card-body">
                        <form method="post" action="{{route('products.store')}}">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" name="name" class="form-control" placeholder="Nome do Produto"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>Descricao</label>
                                <input type="text" name="description" placeholder="Descrição do produto"
                                       class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Preço</label>
                                <input type="number" name="price" placeholder="Preço do produto" class="form-control"
                                       value="0" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


