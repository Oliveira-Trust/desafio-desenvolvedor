@extends('welcome')

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Editar usuário</h3>
    </div>
    <div class = "panel-heading">
        <div class = "row m-1">
            <div class = "col-xs-4 align-left">
                <a href = "{{ route('home.user') }}" role = "button" class = "btn btn-secondary" aria-expanded = "false">
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
    <form role="form" method = "post" action = "{{ route('update.user') }}">
      <div class="card-body">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" value = "{{ $user->name }}" name = "name" placeholder="Nome">
          </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" value = "{{ $user->email }}" name = "email" placeholder="Email">
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Atualizar</button>
      </div>
    </form>
  </div>
@endsection
