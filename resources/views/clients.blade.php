@extends('layouts.app')

@push('script')
    <script>
    
    </script>
@endpush

@section('content')
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<div class="row">
  <div class="col"><h1>Clientes</h1></div>
  <div class="col">
      <div class="float-right">
        <a href="{{route('clients.create')}}" class="btn btn-success">
         <i class="fas fa-plus"></i> Novo Cliente
        </a>
      </div>
  </div>
</div>

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Enderço</th>
        <th>Editar</th>
      </tr>
    </thead>
    <tbody id="tbody">
        @foreach ($clients as $client)            
        <tr>
          <td>{{$client->id}}</td>
          <td>{{$client->name}}</td>
          <td>{{$client->cpf}}</td>
          <td>{{$client->address}}</td>
          <td>
              <a href="{{route('clients.show', $client->id)}}" class="btn btn-primary">Detalhes</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
      

@endsection