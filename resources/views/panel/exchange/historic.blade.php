@php use App\Enums\PaymentType; @endphp
@extends('panel.template.panel')

@section('title-page')
    Histórico de Conversão de Moedas
@endsection

@section('content')
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-border panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Histórico</h3>
                    </div>
                    <div class="panel-body table-rep-plugin">
                        <div class="table-responsive">
                            <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 22%">Usuário</th>
                                    <th class="text-center" style="width: 10%">Moeda Origem</th>
                                    <th class="text-center" style="width: 10%">Moeda Destino</th>
                                    <th class="text-center" style="width: 10%">Valor</th>
                                    <th class="text-center" style="width: 12%">Valor Moeda Destino</th>
                                    <th class="text-center" style="width: 10%">Tipo Pag.</th>
                                    <th class="text-center" style="width: 7%">Taxa Pag.</th>
                                    <th class="text-center" style="width: 7%">Taxa Conv.</th>
                                    <th class="text-center" style="width: 10%">Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($currencyExchangeHistoricData as $historic)
                                    <tr>
                                        <td>{{ $historic->user?->name }}</td>
                                        <td class="text-center">{{ $historic->source_currency }}</td>
                                        <td class="text-center">{{ $historic->destination_currency }}</td>
                                        <td class="text-center">{{ formatCurrencyValue($historic->conversion_value) }}</td>
                                        <td class="text-center">{{ formatCurrencyValue($historic->currency_bid) }}</td>
                                        <td class="text-center">{{ PaymentType::getLabel($historic->payment_type) }}</td>
                                        <td class="text-center">{{ formatPercentValue($historic->payment_tax) }}</td>
                                        <td class="text-center">{{ formatPercentValue($historic->conversion_tax) }}</td>
                                        <td class="text-center">{{ formatDateAndTime($historic->created_at) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Nenhum histórico foi encontrado</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div>
@endsection
