<div class="container" style="max-width:100%;padding: 2em">
    <div class="card">
        <div class="card-footer">
            <h3>Histórico de conversão deste usuário</h3>
            @if(empty($historicos))
                <small>Não há conversões realizadas por este usuário.</small>
            @endif
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Valor para conversão</th>
                        <th>Valor Convertido</th>
                        <th>Moeda Original</th>
                        <th>Moeda Destino</th>
                        <th>Tipo Pagamento</th>
                        <th>Taxa(Forma de Pagamento)</th>
                        <th>Taxa(Conversão)</th>
                        <th>Valor usado na conversão</th>
                        <th>Valor da moeda no dia</th>
                        <th>Data da Cotação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historicos as $historico)
                        <tr>
                            <td>{{round($historico->valor_inicial, 3)}}</td>
                            <td>{{round($historico->valor_comprado, 3)}}</td>
                            <td>{{$historico->moedaOriginal}}</td>
                            <td>{{$historico->moedaDestino}}</td>
                            <td>{{$historico->tipo_pagamento}}</td>
                            <td>{{$historico->valor_taxa_tipo_pagamento}}</td>
                            <td>{{$historico->valor_taxa_conversao}}</td>
                            <td>{{$historico->valor_inicial_taxado}}</td>
                            <td>{{$historico->valor_moeda_destino}}</td>
                            <td>{{$historico->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$historicos->links()}}
        </div>
    </div>
</div>
