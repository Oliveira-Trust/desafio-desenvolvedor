@extends('layouts.app')

@section('content')
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

    <div class="card">
        <div class="card-header">
            <h1>Cadastro de Cliente</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('clients.store')}}">
                @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">Nome</label>
                        <input type="text" name="name" class="@error('name') is-invalid @enderror form-control" id="name" value="{{old('name')}}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">CPF</label>
                        <input type="text" name="cpf" class="@error('cpf') is-invalid @enderror form-control" id="cpf" value="{{old('cpf')}}">
                        @error('cpf')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>                    
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="phone">Telefone</label>
                        <input type="text" name="phone" class="@error('phone') is-invalid @enderror form-control" id="phone" value="{{old('phone')}}">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="address">Endereço</label>
                        <input type="text" name="address" class="@error('address') is-invalid @enderror form-control" id="address" value="{{old('address')}}">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
                <a href="{{route('clients.index')}}" class="btn btn-secondary">Voltar</a>
              </form>
        </div>
      </div>
      
@endsection