@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Listagem de Clientes <br><a class="btn btn-link float-right" href="{{ route('customer.create') }}">Cadastrar novo</a></div>
                    <div class="card-body">
                        <form method="get" action="{{ route('customer.index') }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>CPF</label>
                                    <input type="text" class="form-control" name="cpf">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="order" class="custom-control-input" value="name">
                                <label class="custom-control-label" for="customRadioInline1">Ordernar por nome</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="order" class="custom-control-input" value="id">
                                <label class="custom-control-label" for="customRadioInline2">Ou por id</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline3" name="order" class="custom-control-input" value="email">
                                <label class="custom-control-label" for="customRadioInline3">Ou por email</label>
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
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            @foreach($results as $customer)
                                <tr>
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->cpf}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">
                                                Ação
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu" style="min-width: 140px;">
                                                <li><a href="{{ route('customer.show',$customer->id) }}" class="btn btn-default">Detalhe</a>
                                                </li>
                                                <li><a href="{{ route('customer.edit',$customer->id) }}" class="btn btn-default">Editar</a>
                                                </li>
                                                <li>
                                                    <form method="post" action="{{ route('customer.destroy',$customer->id) }}">
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
