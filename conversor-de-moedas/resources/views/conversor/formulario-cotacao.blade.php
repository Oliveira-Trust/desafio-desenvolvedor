@extends('layouts.layout')

@section('title', 'Formulário de conversão de moeda BRL')

@section('content')
<div class="container">
    <div class="btn-container">
        <a href="/" class="btn-home-conversor mt-4">Home</a>
        <a href="/" class="seta-link mt-4">
            <img src="{{ asset('assets/icons/icon-seta.svg') }}" class="seta">
        </a>
    </div>
    <div class="row">
        <div id="quadro-conversor">
            <h3 class="text-center my-4">Conversor de Moeda BRL</h3>
            <form id="formularioConversao" action="/converter" method="POST">
                @csrf
                <div class="form-group">
                    <label for="moedaDestino">Moeda de Destino</label>
                    <select id="moedaDestino" name="moedaDestino" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="USD" {{ old('moedaDestino', $moedaDestino ?? '') == 'USD' ? 'selected' : '' }}>USD - Dólar Americano</option>
                        <option value="EUR" {{ old('moedaDestino', $moedaDestino ?? '') == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                        <option value="GBP" {{ old('moedaDestino', $moedaDestino ?? '') == 'GBP' ? 'selected' : '' }}>GBP - Libra Esterlina</option>
                        <option value="JPY" {{ old('moedaDestino', $moedaDestino ?? '') == 'JPY' ? 'selected' : '' }}>JPY - Iene Japonês</option>
                        <option value="AUD" {{ old('moedaDestino', $moedaDestino ?? '') == 'AUD' ? 'selected' : '' }}>AUD - Dólar Australiano</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantidade">Valor para Conversão (BRL)</label>
                    <input type="number" id="quantidade" name="quantidade" min="1000" max="100000" class="form-control" value="{{ old('quantidade', $quantidade ?? '') }}" placeholder="O valor mínimo é R$1.000" required>
                </div>
                <div class="form-group">
                    <label for="metodoPagamento">Forma de Pagamento</label>
                    <select id="metodoPagamento" name="metodoPagamento" class="form-control" required>
                        <option value="">Selecione</option>
                        <option value="boleto" {{ old('metodoPagamento', $metodoPagamento ?? '') == 'boleto' ? 'selected' : '' }}>Boleto</option>
                        <option value="cartao_de_credito" {{ old('metodoPagamento', $metodoPagamento ?? '') == 'cartao_de_credito' ? 'selected' : '' }}>Cartão de Crédito</option>
                    </select>
                </div>
                <div class="input-container mt-4">
                    <h6>Configuração de taxas</h6>
                    <input type="number" class="form-control" id="valor-moeda-destino" name="valor-moeda-destino" placeholder="Valor moeda destino" title="Valor moeda destino" value="{{ old('valor-moeda-destino', $valorMoedaDestinoInput) }}" />
                    <input type="number" class="form-control mt-1" id="taxa-pagamento" name="taxa-pagamento" placeholder="Taxa de pagamento" title="Taxa de pagamento" value="{{ old('taxa-pagamento', $taxaPagamentoInput) }}" />
                    <input type="number" class="form-control mt-1" id="taxa-conversao-adicional" name="taxa-conversao-adicional" placeholder="Taxa de conversão adicional" title="Taxa de conversão adicional" value="{{ old('taxa-conversao-adicional', $taxaConversaoAdicionalInput) }}" />
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn" id="btn-converter">Converter</button>                 
                    <button type="reset" class="btn" id="btn-resetar">Resetar</button>                 
                </div>
            </form>
        </div>
        
        <div id="resultado">
            <h4 >Informações sobre a Conversão</h4>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Descrição</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Moeda de origem</td>
                        <td>BRL</td>
                    </tr>
                    <tr>
                        <td>Moeda de destino</td>
                        <td>{{ $nomeMoedaDestino }}</td>
                    </tr>
                    <tr>
                        <td>Valor moeda destino</td>
                        <td>1 BRL = {{ $valorMoedaDestinoUsadoParaConversao }} {{ $nomeMoedaDestino }}</td>
                    </tr>   
                    <tr>
                        <td>Valor para conversão</td>
                        <td>R$ {{ number_format($quantidade, 2, ',', '.') }}</td>
                    </tr>                                                     
                    <tr>
                        <td>Taxa de pagamento</td>
                        <td>R$ {{ $taxaDePagamento }}</td>
                    </tr>
                    <tr>
                        <td>Taxa de conversão adicional</td>
                        <td>R$ {{ $taxaDeConversaoAdicional }}</td>
                    </tr>                            
                    <tr>
                        <td>Valor para conversão com as taxas aplicadas</td>
                        <td>R$ {{ $quantidadeAposTaxas }}</td>
                    </tr>
                    <tr>
                        <td>Valor comprado em {{ $nomeMoedaDestino }}</td>
                        <td>{{ $quantidadeConvertida }}</td>
                    </tr>
                    <tr>
                        <td>Forma de pagamento</td>
                        <td>{{ $metodoPagamento == 'boleto' ? 'Boleto' : 'Cartão de Crédito' }}</td>
                    </tr>
                </tbody>
            </table>
            <form id="formularioEmail" action="/enviar-email" method="POST" class="form-inline mt-4">
                @csrf
                <label for="email">Endereço de e-mail:</label>
                <input type="email" id="email" name="email" class="form-control ml-3" placeholder="Digite seu e-mail" required>
                <button type="submit" class="btn ml-3" id="btn-enviar-email">Enviar e-mail</button>
            </form>

            <div id="message-success" class="alert alert-success mt-3" style="display: none;"></div>
            <div id="message-error" class="alert alert-danger mt-3" style="display: none;"></div>
        </div>        
    </div>        
</div>
@endsection
