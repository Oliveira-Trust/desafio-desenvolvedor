<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="{{ asset('css/semantic.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <title>Conversor de Moedas</title>
</head>

<body>
    <div class="ui grid">
        <div class="three column row">
            <div class="column"><img class="ui small image" src={{ asset('images/oliveira-trust-logo.jfif') }}></div>
            <div class="column">
                <h1 class="ui header"> Conversor de Moedas </h1>
            </div>
            <div class="column">&nbsp;</div>

        </div>
    </div>
    <div class="ui divider"></div>
    <div class="ui container">
        <form method="POST" class="ui form">
            @csrf
            <div class="field">
                <label>Moeda de destino</label>
                <select name="moeda-destino" id="moeda-destino" class="ui fluid dropdown">
                    <option value=""> Selecione </option>
                    @foreach ($moedas as $moeda => $index)
                    <option value="{{ $moeda }}">{{ $index}}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Valor para Conversão</label>
                <input type="text" name="valor-conversao" id="valor-conversao" placeholder="Valor">
            </div>
            <div class="field">
                <label>Forma de Pagamento</label>
                <select name="forma-pagamento" id="forma-pagamento" class="ui fluid dropdown">
                    <option value="">Selecione</option>
                    <option value="B">Boleto</option>
                    <option value="C">Cartão de Crédito</option>
                </select>
            </div>
            <button id="converter" class="ui button compact large green" type="button">Converter</button>
        </form>
    </div>
    <div class="ui divider"></div>
    <div class="ui container" id="dadosConversao" style="display: none;">
        <div class="ui centered card">
            <div class="content">
                <div class="header">Compra/Conversão de Moeda</div>
            </div>
            <div class="content">
                <h4 class="ui sub header">Informações</h4>
                <div class="ui small feed">
                    <div class="event">
                        <div class="content">
                            <div class="summary">
                                <span id="moedaOrigem"></span>
                            </div>
                            <div class="summary">
                                <span id="moedaDestino"></span>
                            </div>
                            <div class="summary">
                                <span id="valorConversao"></span>
                            </div>
                            <div class="summary">
                                <span id="formaPagamento"></span>
                            </div>
                            <div class="summary">
                                <span id="valorMoedaDestino"></span>
                            </div>
                            <div class="summary">
                                <span id="valorCompradoMoedaDestino"></span>
                            </div>
                            <div class="summary">
                                <span id="taxaPagamento"></span>
                            </div>
                            <div class="summary">
                                <span id="taxaConversao"></span>
                            </div>
                            <div class="summary">
                                <span id="valorConversaoDescontos"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui divider"></div>
</body>

</html>
<script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>