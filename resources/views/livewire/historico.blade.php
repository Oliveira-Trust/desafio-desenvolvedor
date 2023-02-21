
<div class="row">
    <div class="col-lg-8  offset-lg-2 mb-4">
        <div class="card">
        <h5 class="card-header">Ultimas conversões</h5>
            <div class="table-responsive text-nowrap">
                @if(count($conversoes))
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Data</th>
                            <th>Moeda</th>
                            <th>Valor</th>
                            <th>Cotação</th>
                            <th>Valor Pago</th>
                            <th>Taxa de conversão</th>
                            <th>Forma de Pagamento</th>
                            <th>Taxa Forma de PGTO</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($conversoes as $conversao)
                                <tr>
                                    <td>{{$conversao['data']}}</td>
                                    <td><strong>{{$conversao['moeda_destino']}}</strong></td>
                                    <td><span class="badge bg-label-success me-1"><strong>{{round($conversao['valor_convertido'],2)}}</strong></span></td>
                                    <td><span class="badge bg-label-warning me-1">R$ {{number_format($conversao['valor_cotacao'],2,",",".")}}</span></td>
                                    <td>R$ {{number_format($conversao['valor_compra'],2,",",".")}}</td>
                                    <td>R$ {{number_format($conversao['taxa_conversao'],2,",",".")}}</td>
                                    <td>{{$conversao['forma_pgto']}}</td>
                                    <td>R$ {{number_format($conversao['taxa_pagamento'],2,",",".")}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="mb-3 text-center">Sem conversões realizadas.</div>
                @endif
            </div>
        </div>
        <!-- FIM TABELA-->
    </div>
</div>
