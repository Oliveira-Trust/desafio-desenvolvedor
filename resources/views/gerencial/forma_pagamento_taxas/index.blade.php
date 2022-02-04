
@extends('layouts.sb-admin-2.projeto.corpo')
@section('content')
@include('layouts.sb-admin-2.topo_msg')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-money-bill"></i> Taxas de Formas de Pagamento </h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    <nav aria-label="breadcrumb-gv">
        <ol class="breadcrumb-gv">
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Inicio</a></li>
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('forma_pagamento_taxas.index') }}"><i class="fas fa-money-bill"></i> Taxas de Formas de Pagamento</a></li>
            <li class="breadcrumb-gv-item active">Listar</li>
        </ol>
    </nav>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered data-table-padrao" id="data-table-produtos" width="100%" cellspacing="0">
                <thead >
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Porcentagem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formaPagamentoTaxas as $formaPagamentoTaxa)
                    <tr>
                        <td>{{ $formaPagamentoTaxa->id }}</td>
                        <td>{{ $formaPagamentoTaxa->tipo == 'B' ? 'Boleto' : 'Cartão' }}</td>
                        <td>{{ \App\Helpers\FormataHelper::formataValor($formaPagamentoTaxa->porcentagem) }} % </td>
                        <td class="text-center">
                            <a data-toggle="tooltip" data-placement="top"  title="Editar" class="btn btn-warning btn-sm" href="{{ route('forma_pagamento_taxas.editar',$formaPagamentoTaxa->id) }}"><i class="fas fa-pen"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
            <div class="float-left">
                <div class="dataTables_info">
                    <i> Mostrando {!! $formaPagamentoTaxas->firstItem() !!} a {!!$formaPagamentoTaxas->lastItem() !!} de um total de {!!$formaPagamentoTaxas->total() !!}  </i>
                </div>
            </div>
            <div class="float-right">
                {!! $formaPagamentoTaxas->appends($_GET)->links() !!}
            </div>
        </div>    
    </div>    
</div> 
@include('layouts.sb-admin-2.index_modals', ['titulo' => 'Remover Forma de Pagamento', 'mensagem' => 'Selecione "Sim" para remover a Forma de Pagamento'])
<!-- {!! $formaPagamentoTaxas->links() !!} -->
<!-- <script type="text/javascript" src="{{asset('js/usuarios/index.js')}}"></script>  -->
@endsection