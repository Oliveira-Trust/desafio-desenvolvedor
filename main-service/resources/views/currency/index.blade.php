@extends('layout.site')

@section('title', 'Currency - Dashboard')

@section('conteudo')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- CONTENT -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Moedas Cadastrados<small></small>
                        <a href="{{ route('currencies.create') }}" class="btn btn-success btn-xs" alt="Cadastrar nova Moeda" title="Cadastrar nova Moeda">
                            <i class="fa fa-edit"></i> Nova
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
                      Relação de todas as moedas cadastradas no sistema
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
                                <th>Sigla</th>
                                <th>Código</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencies as $currency)
                                <tr>
                                    <td>{{ strtoupper($currency['code']) }}</td>
                                    <td>{{ $currency['name'] }}</td>
                                    <td>
                                            @if ($currency['status'] == '1') Ativa @endif
                                            @if ($currency['status'] == '0') Inativa @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('currencies.edit', $currency['id']) }}" class="btn btn-warning btn-xs" title="Editar currency">Editar</a>
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
