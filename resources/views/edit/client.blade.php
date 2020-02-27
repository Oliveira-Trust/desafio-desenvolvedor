@extends('layouts.app')

@section('content')
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

    <div class="card">
        <div class="card-header">
            <h1>Edição de Cliente</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('clients.update', $client->id)}}">
                @csrf @method('PATCH')
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$client->name}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">CPF</label>
                        <input type="text" name="cpf" class="form-control" id="exampleInputPassword1" value="{{$client->cpf}}">
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-sm-12">
                        <label for="address">Endereço</label>
                        <input type="text" name="address" class="form-control" id="address" value="{{$client->address}}">
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Atualizar</button>
                <a href="{{route('clients.index')}}" class="btn btn-secondary">Voltar</a>
              </form>
        </div>
      </div>
      
@endsection