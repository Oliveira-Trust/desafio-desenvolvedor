@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Visualizar Clientes</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-12 table-responsive-sm">
                            <table class="table table-sm table-striped table-bordered table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Opções</th>
                                        <th>Id</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Data Inclusão</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listUsers as $user)
                                        <tr>
                                            <td>
                                                <button type="button" user_id="{{ $user->id }}" class="btn btn-xs btn-outline-danger destroyClient" title="Excluir Cliente">
                                                    <i class="material-icons vertical-align-sub md-17">person_add_disabled</i> 
                                                </button>
                                                <button type="button" user_id="{{ $user->id }}" class="btn btn-xs btn-outline-success" title="Editar Cliente">
                                                    <i class="material-icons vertical-align-sub md-17">edit</i> 
                                                </button>
                                            </td>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/client/view.js') }}" type="text/javascript"></script>
<script>
    ClientView.init();
</script>
@endsection
