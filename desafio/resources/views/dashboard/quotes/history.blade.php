@extends('dashboard.templates.app')

@section('title', 'Histórico de cotação')

@section('content-dash')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Histórico de cotação</h2>
        
            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Histórico de cotação</span></li>
                </ol>
        
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">HISTÓRICO DE COTAÇÃO</h2>
                    </header>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped mb-none" id="t-quote">
                                    <thead>
                                        <tr>
                                            <th>MOEDA BASE</th>
                                            <th>MOEDA COMPRA</th>
                                            <th>FORMA PAGAMENTO</th>
                                            <th>VALOR COTADO</th>
                                            <th>VALOR MOEDA ORIGEM</th>
                                            <th>TAXA PAGAMENTO</th>
                                            <th>TAXA CONVERSÃO</th>
                                            <th>VALOR SEM TAXA</th>
                                            <th>VALOR COMPRADO</th>
                                            <th>DATA COTAÇÃO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quotes as $quote)
                                            <tr>
                                                <td><span class="label label-default">{{ $quote->code }}</span></td>
                                                <td>{{ $quote->code_in }}</td>
                                                <td>
                                                    @if ($quote->payment_method === 'CRÉDITO')
                                                        <span class="label label-success">{{ $quote->payment_method }}</span>
                                                    @else
                                                        <span class="label label-warning">{{ $quote->payment_method }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $quote->conversion_value }}</td>
                                                <td>{{ $quote->destination_currency_value }}</td>
                                                <td>{{ $quote->payment_rate }}</td>
                                                <td>{{ $quote->conversion_rate }}</td>
                                                <td>{{ $quote->conversion_value_tax }}</td>
                                                <td>{{ $quote->purchased_value }}</td>
                                                <td>{{ $quote->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent

    <!-- Specific Page Vendor -->
		<script src="/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="/assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="/assets/javascripts/theme.custom.js"></script>

		<!-- Examples -->
		<script src="/assets/javascripts/tables/examples.datatables.default.js"></script>
@endsection