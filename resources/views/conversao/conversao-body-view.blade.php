<div class="container" style="max-width:100%;padding: 2em">
    <div class="card" style="padding: 2em">
        <div class="card-body" style="padding: 2em">
            <h3>Resultado da Conversão</h3>
            <div class="card-deck mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body" >
                                <strong>Conversão de:</strong> {{$dadosMoedaOriginal->nome_moeda}}/{{$dadosMoedaOriginal->abreviacao_moeda}}<br>
                                <strong>Valor a converter:</strong> {{$valorInicial}}<br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <strong>Para:</strong> {{$dadosMoedaDestino->nome_moeda}}/{{$dadosMoedaDestino->abreviacao_moeda}}<br>
                                <strong>Resultado da conversão:</strong> {{$valorConvertido}} {{$dadosMoedaDestino->abreviacao_moeda}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card-body">
                    <strong>Forma de pagamento:</strong> {{$dadosPagamento->tipo_pagamento}}<br>
                    <strong>Valor do {{$dadosMoedaDestino->nome_moeda}}</strong>: {{$valorMoedaDestino}} {{$dadosMoedaDestino->abreviacao_moeda}}<br>
                    <strong>Valor utilizado para conversão descontando as taxas:</strong> {{$valorInicialTaxado}} {{$dadosMoedaOriginal->abreviacao_moeda}}<br>
                    <strong>Taxa da Forma de Pagamento:</strong> {{$valorTaxaTipoPagamento}} {{$dadosMoedaOriginal->abreviacao_moeda}}<br>
                    <strong>Taxa de conversão:</strong> {{$valorTaxaConversao}} {{$dadosMoedaOriginal->abreviacao_moeda}}<br>
                </div>
            </div>
        </div>
    </div>
</div>
