@extends('layouts.app')

@push('scripts')
    <script src="js/clients.js"></script>
@endpush

@section('content')
@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

<h1>Clientes</h1>

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
      <div class="d-flex justify-content-between">
        <a href="{{route('clients.create')}}" class="btn btn-success">Cadastrar</a>
        {{ $clients->links() }}
      </div>

@endsection