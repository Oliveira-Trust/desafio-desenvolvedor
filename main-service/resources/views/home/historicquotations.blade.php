@extends('layout.site')

@section('title', 'Taxas sobre Valores - Dashboard')

@section('conteudo')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- CONTENT -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Histórico de Cotações<small></small>
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
                      Relação de todas as Cotações realizadas
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
                                <th>Data</th>
                                <th>De - Para</th>
                                <th>Cliente</th>
                                <th>Vlr Inicial</th>
                                <th>Forma Pgto</th>
                                <th>Tx Pgto</th>
                                <th>Tx Conversão</th>
                                <th>Vlr com Txs</th>
                                <th>Cotação</th>
                                <th>Vlr Final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotations as $quotation)
                                <tr>
                                    <td>R$ {{ $quotation['created_at'] }}</td>
                                    <td>{{ $quotation['user']['name'] }}</td>
                                    <td>{{ $quotation['from_currency'] }} - {{ $quotation['to_currency'],}}</td>
                                    <td>R$ {{ $quotation['amount'] }}</td>
                                    <td>{{ $quotation['payment_method'] }}</td>
                                    <td>R$ {{ $quotation['payment_fee'] }}</td>
                                    <td>R$ {{ $quotation['conversion_fee'] }}</td>
                                    <td>R$ {{ $quotation['new_amount'] }}</td>
                                    <td>R$ {{ $quotation['quotation'] }}</td>
                                    <td>{{ $quotation['to_currency'],}} {{ $quotation['amount_converted'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  <!-- END-CONTENT -->
    </div> <!-- /page content -->
@endsection
