@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Listagem de Produtos <br><a class="btn btn-link float-right" href="{{ route('product.create') }}">Cadastrar novo</a></div>
                    <div class="card-body">
                        <form method="get" action="{{ route('product.index') }}">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="order" class="custom-control-input" value="name">
                                <label class="custom-control-label" for="customRadioInline1">Ordernar por nome</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="order" class="custom-control-input" value="price">
                                <label class="custom-control-label" for="customRadioInline2">Ou por preço</label>
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Pesquisar</button>
                            </div>
                        </form>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            @foreach($results as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>R$ {{number_format($product->price,2,',','.')}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">
                                                Ação
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu" style="min-width: 140px;">
                                                <li><a href="{{ route('product.show',$product->id) }}" class="btn btn-default">Detalhe</a>
                                                </li>
                                                <li><a href="{{ route('product.edit',$product->id) }}" class="btn btn-default">Editar</a>
                                                </li>
                                                <li>
                                                    <form method="post" action="{{ route('product.destroy',$product->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-block"><span
                                                                class="glyphicon glyphicon-trash"></span>Excluir
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
