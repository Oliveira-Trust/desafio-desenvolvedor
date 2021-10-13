@extends('layout.site')

@section('title', 'Meio de Pagamento - Dashboard')

@section('conteudo')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- CONTENT -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Meios de Pagamento<small></small>
                        <a href="{{ route('payment-methods.create') }}" class="btn btn-success btn-xs" title="Cadastrar novo Meio de Pagamento">
                            <i class="fa fa-edit"></i> Novo
                        </a>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Relação de todos os Meio de Pagamento cadastrados no sistema
                    </p>

                    <!-- Mensagem confirmação evento -->
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('message')}}
                        </div>
                    @endif

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                            <tr>
                                <th>Meio de Pgto</th>
                                <th>Taxa</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paymentMethods as $paymentMethod)
                                <tr>
                                    <td>{{ $paymentMethod['method'] }}</td>
                                    <td>{{ $paymentMethod['fee'] }}</td>
                                    <td>
                                            @if ($paymentMethod['status'] == '1') Ativo @endif
                                            @if ($paymentMethod['status'] == '0') Inativo @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('payment-methods.edit', $paymentMethod['id']) }}" class="btn btn-warning btn-xs" title="Editar Meio de Pgto">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  <!-- END-CONTENT -->
    </div> <!-- /page content -->
@endsection
