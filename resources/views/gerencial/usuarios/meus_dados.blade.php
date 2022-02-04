@extends('layouts.sb-admin-2.projeto.corpo')
@section('content')
@include('layouts.sb-admin-2.topo_msg')
<script>
    rotaAtualizarFoto = '';
    rotaSalvarCredencial = '';
    rotaBuscarCredenciais = '';
    rotaAtualizarFoto = "{{ route('usuarios.atualizarFoto',$usuario->id) }}";
</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user"></i> Dados pessoais</h1>
    <nav aria-label="breadcrumb-gv">
        <ol class="breadcrumb-gv">
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Inicio</a></li>
            <li class="breadcrumb-gv-item active"><i class="fas fa-user"></i> Dados pessoais </li>
        </ol>
    </nav>
</div>
<div class="alert alert-warning margin-top-0" id="div-top">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    Os campos marcados com <b class="text-danger">*</b> são de preenchimento obrigatório.
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Atenção!</strong> Ocorreram erros no formulário.
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-body">
       
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="dados-usuario" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="foto-usuario" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Foto</a>
                </li>
            </ul>
            <div class="tab-content" id="div-tab-content">
                <div class="tab-pane fade show active " id="home" role="tabpanel" aria-labelledby="dados-usuario">
                    <div class="col-lg-12 col-md-12 pt-4">
                        <form action="{{ route('usuarios.atualizar_meus_dados',$usuario->id) }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('gerencial.usuarios.campos_usuario')

                            <button type="submit" class="btn btn-success btn-icon-split ">
                                <span class="icon text-white-50">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="text">Atualizar</span>
                            </button>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-danger btn-icon-split ">
                                <span class="icon text-white-50">
                                    <i class="fas fa-times-circle"></i>
                                </span>
                                <span class="text">Cancelar</span>
                            </a>
                            <!-- Content -->
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="foto-usuario">
                    <div class="col-lg-12 col-md-12 pt-4 pb-4">
                        @include('gerencial.usuarios.foto')
                    </div>
                </div>
            </div>
    </div>
</div>
@include('layouts.sb-admin-2.index_modals', ['titulo' => 'Remover credencial', 'mensagem' => 'Selecione "Sim" para remover a credencial'])
@endsection