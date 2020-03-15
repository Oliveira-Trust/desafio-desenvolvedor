@extends('layouts.template')

@section('title', 'Usuários')

@section('content')

    <div class="container p-5">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('danger'))
            <div class="alert alert-danger">{{ session('danger') }}</div>
        @endif

        <h2>Lista de Usuários</h2>
        <hr>
        <a href="{{route('user.create')}}" class="btn btn-md btn-success mb-2">Novo Usuário</a>

        <form class="row mt-2 mb-3" method="get">

            <div class="col-md-2 col-form-label font-weight-bold mb-2">Nome:</div>
            <div class="col-md-4 mb-2"><input type="text" class="form-control" name="name" id="name" value="{{ $filters['name'] ? $filters['name'] : '' }}"></div>

            <div class="col-md-2 col-form-label font-weight-bold mb-2">E-mail:</div>
            <div class="col-md-4 mb-2"><input type="text" class="form-control" name="email" id="email" value="{{ $filters['email'] ? $filters['email'] : '' }}"></div>


            <div class="col-md-2 col-form-label font-weight-bold">Tipo de Acesso:</div>
            <div class="col-md-4">
                <select name="access" id="access" class="form-control">
                    <option value="0">Todos</option>
                    <option {{ $filters['access'] == 'USER' ? 'selected' : '' }} value="USER">Usuário Comum</option>
                    <option {{ $filters['access'] == 'ADMIN' ? 'selected' : '' }} value="ADMIN">Administrador</option>
                </select>
            </div>

            <div class="col-md-2 col-form-label font-weight-bold">Ordernar por:</div>
            <div class="col-md-4">
                <select name="order" id="order" class="form-control">
                    <option {{ $filters['order'] == 'created_at' ? 'selected' : '' }} value="created_at">Data</option>
                    <option {{ $filters['order'] == 'id' ? 'selected' : '' }} value="id">ID</option>
                    <option {{ $filters['order'] == 'name' ? 'selected' : '' }} value="name">Nome</option>
                    <option {{ $filters['order'] == 'email' ? 'selected' : '' }} value="email">E-mail</option>
                    <option {{ $filters['order'] == 'access' ? 'selected' : '' }} value="access">Tipo de Usuário</option>
                </select>
            </div>

            <div class="col-md-8 mt-4"></div>
            <div class="col-md-4 mt-4">
                <button class="btn btn-md btn-info btn-block text-light">Filtrar</button>
            </div>
        </form>

        @if($users->count() > 0)
            <table class="table table-stripped table-hover">
                <thead class="bg-primary text-light">
                <tr>
                    <th class="text-center" width="80">ID</th>
                    <th class="text-center">NOME</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">TIPO</th>
                    <th width="160" class="text-center">AÇÕES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center">{{$user->id}}</td>
                        <td class="text-center">{{$user->name}}</td>
                        <td class="text-center">{{$user->email}}</td>
                        <td class="text-center">{{$user->access}}</td>
                        <td class="text-center">
                            <span class="btn-group">
                                <a href="{{route('user.show', $user->id)}}" class="btn btn-sm btn-primary">Ver</a>
                                <a href="{{route('user.edit', $user->id)}}" class="btn btn-sm btn-warning ml-1">Editar</a>
                                <form action="{{route('user.destroy', $user->id)}}" method="post" class="form-inline" id="form-del-{{$user->id}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="confirmDelete(this, event, 'form-del-{{$user->id}}')">Excluir</button>
                                </form>
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                Nenhum produto cadastrado!!!
            </div>
        @endif

    </div>

@endsection

@section('scripts')
    <script>
        function confirmDelete(t, e, id) {
            e.preventDefault();

            $('.modal-header, .close').addClass('bg-danger').addClass('text-light');
            $('#title-modal').html('Deseja Realmente excluir esse anúncio?')

            $('.modal-body').html('Apagando esse anúncio todos dados relacionados a ele irá ser apagado também!');

            $('#cancel').removeClass('btn-secondary').addClass('btn-default');
            $('#save').removeClass('btn-primary').addClass('btn-danger').data('id', id).html('Apagar');

            $('.modal').modal('show');
        }

        $(document).on('click', '#save', function () {
            let id = $(this).data('id');
            document.getElementById(id).submit();
            $('.modal').modal('hide');
        });
    </script>
@endsection
