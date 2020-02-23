@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Listagem de Clientes <br><a class="btn btn-link float-right" href="{{ route('customer.create') }}">Cadastrar novo</a></div>
                    <div class="card-body">
                        <form method="get" action="{{ route('customer.index') }}">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control" name="cpf">
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
