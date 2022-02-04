
@extends('layouts.sb-admin-2.projeto.corpo')
@section('content')
@include('layouts.sb-admin-2.topo_msg')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-users"></i> Listar Tipsters </h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    <nav aria-label="breadcrumb-gv">
        <ol class="breadcrumb-gv">
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Inicio</a></li>
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('usuarios.index') }}"><i class="fas fa-users"></i> Tipsters</a></li>
            <li class="breadcrumb-gv-item active">Listar</li>
        </ol>
    </nav>
</div>
@include('gerencial.usuarios.index_topo')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered data-table-padrao" id="data-table-produtos" width="100%" cellspacing="0">
                <thead >
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nome }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td class="text-center">
                            <a data-toggle="tooltip" data-placement="top"  title="Visualzar"class="btn btn-info btn-sm " href="{{ route('usuarios.visualizar',$usuario->id) }}"><i class="fas fa-search"></i></a>
                            <a data-toggle="tooltip" data-placement="top"  title="Editar" class="btn btn-warning btn-sm" href="{{ route('usuarios.editar',$usuario->id) }}"><i class="fas fa-pen"></i></a>
                            <a href="#" data-action="{{ route('usuarios.deletar',$usuario->id) }}" data-msg="Deseja remover o Tipster <b>{{ $usuario->nome }}</b> ?"  data-toggle="tooltip" data-placement="top"  title="Deletar" class="btn btn-danger btn-sm botao-deletar">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
            <div class="float-left">
                <div class="dataTables_info">
                    <i> Mostrando {!! $usuarios->firstItem() !!} a {!!$usuarios->lastItem() !!} de um total de {!!$usuarios->total() !!}  </i>
                </div>
            </div>
            <div class="float-right">
                {!! $usuarios->appends($_GET)->links() !!}
            </div>
        </div>    
    </div>    
</div> 
@include('layouts.sb-admin-2.index_modals', ['titulo' => 'Remover Tipster', 'mensagem' => 'Selecione "Sim" para remover o Tipster'])
<!-- {!! $usuarios->links() !!} -->
<!-- <script type="text/javascript" src="{{asset('js/usuarios/index.js')}}"></script>  -->
@endsection