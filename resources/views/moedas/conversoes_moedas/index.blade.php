
@extends('layouts.sb-admin-2.projeto.corpo')
@section('content')
@include('layouts.sb-admin-2.topo_msg')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-money-bill"></i> Listar Cotações </h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    <nav aria-label="breadcrumb-gv">
        <ol class="breadcrumb-gv">
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Inicio</a></li>
            <li class="breadcrumb-gv-item"><a class="text-dark" href="{{ route('conversoes_moedas.index') }}"><i class="fas fa-money-bill"></i> Cotações</a></li>
            <li class="breadcrumb-gv-item active">Listar</li>
        </ol>
    </nav>
</div>
@include('moedas.conversoes_moedas.index_topo')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered data-table-padrao" id="data-table-produtos" width="100%" cellspacing="0">
                <thead >
                    <tr>
                        <th>ID</th>
                        <th>Origem</th>
                        <th>Destino</th>
                        <th>Vr Conversão</th>
                        <th>Vr Comprado</th>
                        <th>Email</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conversoesMoedas as $conversaoMoeda)
                    <tr>
                        <td>{{ $conversaoMoeda->id }}</td>
                        <td>{{ $conversaoMoeda->moeda_origem.' - Real' }}</td>
                        <td>{{ $conversaoMoeda->moeda_destino.' - '.($conversaoMoeda->moeda_destino == 'USD' ? 'Dollar Americano' : 'Euro') }}</td>
                        <td>R$ {{ \App\Helpers\FormataHelper::formataValor($conversaoMoeda->valor_conversao) }}</td>
                        <td>R$ {{ \App\Helpers\FormataHelper::formataValor($conversaoMoeda->valor_comprado_moeda_destino) }}</td>
                        <td> {{ $conversaoMoeda->email }}</td>
                        <td class="text-center">
                            <a data-toggle="tooltip" data-placement="top"  title="Visualzar"class="btn btn-info btn-sm " href="{{ route('conversoes_moedas.visualizar',$conversaoMoeda->id) }}"><i class="fas fa-search"></i></a>
                            <a data-toggle="tooltip" data-placement="top"  title="Enviar e-mail" class="btn btn-warning btn-sm" href="{{ route('email.envia',$conversaoMoeda->id) }}"><i class="fas fa-mail-bulk"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
            <div class="float-left">
                <div class="dataTables_info">
                    <i> Mostrando {!! $conversoesMoedas->firstItem() !!} a {!!$conversoesMoedas->lastItem() !!} de um total de {!!$conversoesMoedas->total() !!}  </i>
                </div>
            </div>
            <div class="float-right">
                {!! $conversoesMoedas->appends($_GET)->links() !!}
            </div>
        </div>    
    </div>    
</div> 
@include('layouts.sb-admin-2.index_modals', ['titulo' => 'Remover Forma de Pagamento', 'mensagem' => 'Selecione "Sim" para remover a Forma de Pagamento'])
<!-- {!! $conversoesMoedas->links() !!} -->
<!-- <script type="text/javascript" src="{{asset('js/usuarios/index.js')}}"></script>  -->
@endsection