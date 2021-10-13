@extends('layout.site')

@section('title', 'Taxas sobre Valores - Dashboard')

@section('conteudo')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- CONTENT -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Taxa pela Conversão de Valores<small></small>
                        <a href="{{ route('fees.create') }}" class="btn btn-success btn-xs" title="Cadastrar nova Taxa">
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
                      Relação de todas as Taxas cadastrados no sistema
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
                                <th>Tipo</th>
                                <th>Limite</th>
                                <th>% Taxa Vlr < Limite</th>
                                <th>% Taxa Vlr > Limite</th>
                                <th>Descrição</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fees as $fee)
                                <tr>
                                    <td>{{ $fee['type'] }}</td>
                                    <td>R$ {{ number_format($fee['range'], 2, ',', '.') }}</td>
                                    <td>{{ $fee['less_than'] }}</td>
                                    <td>{{ $fee['more_than'] }}</td>
                                    <td>{{ $fee['description'] }}</td>
                                    <td>
                                            @if ($fee['status'] == '1') Ativo @endif
                                            @if ($fee['status'] == '0') Inativo @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('fees.edit', $fee['id']) }}" class="btn btn-warning btn-xs" title="Editar Taxa">Editar</a>
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
