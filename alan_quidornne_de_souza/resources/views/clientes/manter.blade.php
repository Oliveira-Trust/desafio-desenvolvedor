@extends('layouts.app')

@section('title', 'Clientes')

@section('content')

    <div class="header bg-tema-2 pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Clientes</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href=" {{ route('home') }} "><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item active">Clientes</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5">
                        <div class="text-right">
                            <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#filtros" aria-expanded="false" aria-controls="filtros"><i class="fa fa-search"></i> Filtrar</button>
                            <button type="submit" class="btn btn-success" onclick="abrirModalNovo()"><i class="fa fa-plus"></i> Novo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content -->
    <div class="container-fluid mt--6">

        @component('clientes.filtro', ['campos' => (isset($campos) ? $campos : null), 'listaOrdenacao' => $listaOrdenacao]) @endcomponent

        <form method="POST" action="{{ route('inativarClientesMarcados') }}">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">Listagem</h3>
                        </div>

                            @if(!$clientes->isEmpty())

                                <!-- Light table -->
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th> <input type="checkbox" onchange="marcarDesmarcar($(this))"> </th>
                                                <th>Nome</th>
                                                <th>Telefone</th>
                                                <th>E-mail</th>
                                                <th>Cpf</th>
                                                <th>Endereço Completo</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach($clientes as $chave => $valor)
                                                <tr>
                                                    <td> <input type="checkbox" name="ids[]" class="ids" value="{{ $valor->id }}" onchange="habilitaDesabilitaBtnExcluirMarcados()"> </td>
                                                    <td> {{ $valor->nm_cliente }} </td>
                                                    <td> {{ $valor->telefone }} </td>
                                                    <td> {{ $valor->email }} </td>
                                                    <td> {{ $valor->cpf }} </td>
                                                    <td> {{ $valor->endereco_completo }} </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Detalhar" onclick="abrirModalDetalhar({{ $valor->id }})">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar" onclick="abrirModalEditar({{ $valor->id }})">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Excluir" onclick="inativar({{ $valor->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            @else
                                <div class="card-body">
                                    <div class="pl-lg">
                                        <p>Nenhum registro encontrado.</p>
                                    </div>
                                </div>
                            @endif

                        <!-- Card footer -->
                        <div class="card-footer py-4">
                            <div class="row">
                                <div class="col-6">
                                    <button id="btnExcluirMarcados" type="submit" class="btn btn-danger" onclick="validarExcluirMarcados()" disabled="disabled"><i class="fa fa-trash"></i> Excluir marcados</button>
                                </div>
                                <div class="col-6 text-right">
                                    {{ $clientes->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @component('clientes.modal') @endcomponent

    <script src="{{ asset('js/controles/manterClientes.js') }}"></script>

@endsection