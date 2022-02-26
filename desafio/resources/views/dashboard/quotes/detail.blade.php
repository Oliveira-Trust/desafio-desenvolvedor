<div class="panel-group" id="accordion">
    <div class="panel panel-accordion">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1One">
                    COTAÇÃO ATUAL - {{ $quote->created_at }}
                </a>
            </h4>
        </div>
        <div id="collapse1One" class="accordion-body collapse in">
            <div class="panel-body">

                <div class="row mb-4">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-right sendmail" data-quote="{{ $quote->id }}"><i class="fa fa-envelope"></i> ENVIAR COTAÇAO VIA E-MAIL</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">                    
                        <div class="table-responsive">
                            <table class="table table-bordered mb-none">
                                <tbody>
                                    <tr>
                                        <td class="text-left w1 text-bold">MOEDA BASE</td>
                                        <td><span class="label label-default">{{ $quote->code }}</span></td>
                                    </tr>

                                    <tr>
                                        <td class="text-left w1 text-bold">MOEDA COMPRA</td>
                                        <td>{{ $quote->code_in }}</td>
                                    </tr>

                                    <tr>
                                        <td class="text-left w1 text-bold">FORMA PAGAMENTO</td>
                                        <td>
                                            @if ($quote->payment_method === 'CRÉDITO')
                                                <span class="label label-success">{{ $quote->payment_method }}</span>
                                            @else
                                                <span class="label label-warning">{{ $quote->payment_method }}</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-left w1 text-bold">VALOR COTADO</td>
                                        <td>{{ $quote->conversion_value }}</td>
                                    </tr>

                                    <tr>
                                        <td class="text-left w1 text-bold">VALOR MOEDA ORIGEM</td>
                                        <td>{{ $quote->destination_currency_value }}</td>
                                    </tr>

                                    <tr>
                                        <td class="text-left w1 text-bold" >TAXA MEIO DE PAGEMENTO</td>
                                        <td>{{ $quote->payment_rate }}</td>
                                    </tr>

                                    <tr>
                                        <td class="text-left w1 text-bold">TAXA CONVERSÃO</td>
                                        <td>{{ $quote->conversion_rate }}</td>
                                    </tr>

                                    <tr>
                                        <td class="text-left w1 text-bold">VALOR CONVERSÃO SEM TAXAS</td>
                                        <td>{{ $quote->conversion_value_tax }}</td>
                                    </tr>

                                    <tr>
                                        <td class="text-left w1 text-bold">VALOR COMPRADO</td>
                                        <td>{{ $quote->purchased_value }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>