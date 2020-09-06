@extends('layouts.dashboard.admin')
@section('title', 'Lista de Usuários')
@section('search-route', route('users.search'))

@section('content')
 <main>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Usuários</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{route('users.create')}}" class="btn btn-primary btn-sm">Adicionar</a>
        </div>
      </div>

      @if($message = Session::get('success'))
      <x-alert-success>
            {{$message}}
      </x-alert-success>
    @endif

      @if($message = Session::get('error'))
        <x-alert-danger>
              {{$message}}
        </x-alert-danger>
      @endif

     @if(count($userList) < 1)
        <div class="alert alert-dark" role="alert">
            Não foram encontrados usuários cadastrados!
        </div>
     @else
        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userList as $key => $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @if($user->avar !== null)
                    <td><img src="{{env('APP_URL')}}/storage/{{$user->avatar}}"class="img-fluid img-thumbnail" width="100" height="100" loading="lazy"></td>
                    @else
                    <td><img src="https://via.placeholder.com/100"  width="100" height="100" loading="lazy"></td>
                    @endif
                    <td>
                        <a class="btn btn-sm btn-light" href="{{route('users.show',[$user->id])}}">Visualizar</a>
                        <a class="btn btn-sm btn-warning" href="{{route('users.edit',[$user->id])}}">Editar</a>
                        <a class="btn btn-sm btn-danger" href="{{route('users.destroy',['id'=>$user->id])}}" >Apagar</a></td>
                </tr>
                @endforeach
            </tbody>
            </table>
            @if($userList->contains('links'))
            {{$userList->links()}}
            @endif()
        </div>
    @endif
</main>
@endsection

