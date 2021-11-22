@extends('welcome')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Cadastrar Url</h3>
    </div>
    <div class = "panel-heading">
        <div class = "row m-1">
            <div class = "col-xs-4 align-left">
                <a href = "{{ route('index.cotacao') }}" role = "button" class = "btn btn-secondary" aria-expanded = "false">
                    <i class = "fas fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>
    @if($errors->any())
    <div class = "alert alert-danger mt-5">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form role="form" method = "post" action = "{{ route('create.cotacao') }}">
      <div class="card-body">
        @csrf
        <div class="form-group">
            <label for="name">Valor</label>
            <input type="numeric" class="form-control" id="valor_liquido" name = "valor_liquido" placeholder="Valor">
        </div>
        <div class="form-group">
            <select name = "moeda_origem"  class = "form-control">
                <option value = "BRL" selected>
                    Real
                </option>
            </select>
        </div>
        <div class="form-group">
            <select name = "moeda_destino"  class = "form-control">
                @foreach($moedas as $moeda)
                    <option value = "{{ $moeda->name }}">{{ $moeda->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select name = "forma_pagamento"  class = "form-control">
                <option value = "boleto" selected>
                    Boleto
                </option>
                <option value = "cartao_credito" selected>
                    Cartão de crédito
                </option>
            </select>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Consultar cotação</button>
      </div>
    </form>
  </div>
@endsection
