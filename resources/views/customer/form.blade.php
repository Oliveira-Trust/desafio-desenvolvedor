@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cadastro de Cliente</div>
                    <div class="card-body">
                        <form method="post"
                              action="{{ isset($customer)?route('customer.update',$customer->id):route('customer.store') }}">
                            @csrf
                            @if(isset($customer))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" required value="{{$customer->name??''}}" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" required value="{{$customer->email??''}}" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" required value="{{$customer->cpf??''}}" class="form-control" name="cpf">
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" required value="{{$customer->password??''}}" class="form-control" name="password">
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="admin1" name="admin" class="custom-control-input" value="1">
                                <label class="custom-control-label" for="admin1">É admin</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="admin0" name="admin" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="admin0">Não é admin</label>
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

