@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form action="{{ route('quote') }}" id="value_quote">
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">BRL</div>
                                </div>
                                <input type="text" class="form-control " id="currency_from"
                                    placeholder="entre R$ 1.000,00 ~ R$ 100.000,00" value="5000">
                                <div id="validation_range_value" class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="currency_to">Moeda de destino:</label>
                            <select class="custom-select my-1 mr-sm-2" id="currency_to">
                                <option value="BTC">[BTC] Bitcoin</option>
                                <option value="BOB">[BOB] Boliviano</option>
                                <option value="VEF">[VEF] Bolívar Venezuelano</option>
                                <option value="USD" selected>[USD] Dólar Americano</option>
                                <option value="AUD">[AUD] Dólar Australiano</option>
                                <option value="CAD">[CAD] Dólar Canadense</option>
                                <option value="JMD">[JMD] Dólar Jamaicano</option>
                                <option value="NAD">[NAD] Dólar Namíbio</option>
                                <option value="NZD">[NZD] Dólar Neozelandês</option>
                                <option value="TWD">[TWD] Dólar Taiuanês</option>
                                <option value="ZWL">[ZWL] Dólar Zimbabuense</option>
                                <option value="BSD">[BSD] Dólar das Bahamas</option>
                                <option value="KYD">[KYD] Dólar das Ilhas Cayman</option>
                                <option value="BBD">[BBD] Dólar de Barbados</option>
                                <option value="BZD">[BZD] Dólar de Belize</option>
                                <option value="BND">[BND] Dólar de Brunei</option>
                                <option value="SGD">[SGD] Dólar de Cingapura</option>
                                <option value="FJD">[FJD] Dólar de Fiji</option>
                                <option value="HKD">[HKD] Dólar de Hong Kong</option>
                                <option value="TTD">[TTD] Dólar de Trinidad</option>
                                <option value="XCD">[XCD] Dólar do Caribe Oriental</option>
                                <option value="CVE">[CVE] Escudo cabo-verdiano</option>
                                <option value="ETH">[ETH] Ethereum</option>
                                <option value="EUR">[EUR] Euro</option>
                                <option value="CHF">[CHF] Franco Suíço</option>
                                <option value="UAH">[UAH] Hryvinia Ucraniana</option>
                                <option value="JPY">[JPY] Iene Japonês</option>
                                <option value="GBP">[GBP] Libra Esterlina</option>
                                <option value="ARS">[ARS] Peso Argentino</option>
                                <option value="CLP">[CLP] Peso Chileno</option>
                                <option value="COP">[COP] Peso Colombiano</option>
                                <option value="CUP">[CUP] Peso Cubano</option>
                                <option value="MXN">[MXN] Peso Mexicano</option>
                                <option value="UYU">[UYU] Peso Uruguaio</option>
                                <option value="XRP">[XRP] XRP</option>
                                <option value="DOGE">[DOGE] Dogecoin</option>
                                <option value="CHFRTS">[CHFRTS] Franco Suíço</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="my-1 mr-2" for="payment_type">Forma de pagamento:</label>
                            <select class="custom-select my-1 mr-sm-2" id="payment_type">
                                <option value="1" selected>Boleto</option>
                                <option value="2">Cartão de Crédito</option>
                            </select>
                            <small id="pay_rate" class="form-text text-muted">
                                Para pagamentos em boleto, taxa de 1,45%* <br>
                                Para pagamentos em cartão de crédito, taxa de 7,63%*
                            </small>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="convert">Converter</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-5 d-none">
                <div class="card-header">
                  Resultado da Conversão
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Moeda de origem: BRL</li>
                  <li class="list-group-item">Moeda de destino: USD</li>
                  <li class="list-group-item">Valor para conversão: R$ 5.000,00</li>
                  <li class="list-group-item">Forma de pagamento: Boleto</li>
                  <li class="list-group-item">Valor da "Moeda de destino" usado para conversão: $ 5,30</li>
                  <li class="list-group-item">Valor comprado em "Moeda de destino": $ 920,18 (taxas aplicadas no valor de compra diminuindo no valor total de conversão)</li>
                  <li class="list-group-item">Taxa de pagamento: R$ 72,50</li>
                  <li class="list-group-item">Taxa de conversão: R$ 50,00</li>
                  <li class="list-group-item">Valor utilizado para conversão descontando as taxas: R$ 4.877,50</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
