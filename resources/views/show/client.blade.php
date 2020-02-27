@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h1>Edição de Cliente</h1>
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('clients.destroy', $client->id)}}">
            @csrf @method('DELETE')
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="name">Nome</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{$client->name}}" readonly>
                </div>
                <div class="form-group col-sm-6">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" value="{{$client->cpf}}" readonly>
                </div>                    
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="address">Endereço</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{$client->address}}" readonly>
                </div>
            </div>
            <a href="{{route('clients.edit', $client->id)}}" class="btn btn-primary">Editar</a>
            <button type="submit" class="btn btn-danger">Deletar</a>
        </form>
    </div>
  </div>

@endsection