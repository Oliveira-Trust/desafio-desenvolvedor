@include('stack.script')
@stack('scripts-axios')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @stack('stylesheet')

</head>

<body>

    <div class="container-fluid">

        <header class="currentHeader" id="transform">
            <div class="row">
                <div class="col-2 text-center p-0 m-0">
                    <label for="dataCota">Data da cotação</label>
                    <input type="text" class="form-control inputDataCota text-center" aria-label="dataCota" id="dataCota">
                </div>
            </div>
        </header>

        <hr />

        <div class="row">
            <div class="col-2"></div>
            <div class="col-4">
                <h3>Conversor de Moedas em tempo real</h3>
            </div>
        </div>

        <article class="op1">
            <div class="row">
                <div class="col-4">

                </div>
                <div class="col-4">
                    <label for="inputCard">Taxa Card</label>
                    <input type="text" class="form-control inputDataCota text-center" aria-label="dataCota" id="inputCard" value="7.63">
                </div>
                <div class="col-4">
                    <label for="inputBoleto">Taxa Boleto</label>
                    <input type="text" class="form-control inputDataCota text-center" aria-label="dataCota" id="inputBoleto" value="1.45">
                </div>
            </div>
        </article>

        <article class="op">
            <div class="row">
                <div class="col-1">
                    <label for="myCurrency" class="p-3 m-1">Moeda</label>
                    <select class="form-select  text-center" disabled id="myCurrency">
                        <option value="1">BRL</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="target_value" class="p-3 m-1">Valor da Compra em BRL</label>
                    <input type="text" class="form-control  text-center" id="target_value">
                </div>
                <div class="col-auto">
                    <label for="paymentMethod" class="p-3 m-1">Formas de pagamento...</label>
                    <select class="form-select  text-center" id="paymentMethod">
                        <option value="0"></option>
                        <option id="boleto"></option>
                        <option id="card"></option>
                    </select>
                </div>
                <div class="col-1">
                    <div class="wIcon">
                        <i class="fas fa-exchange"></i>
                    </div>
                </div>
                <div class="col-auto">
                    <label for="label" class="p-3 m-1">Moeda de compra</label>
                    <select class="form-select text-center" id="targetSelect">
                        <option value="0"></option>
                    </select>
                </div>
        </article>

        <div class="resultOne">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-4">
                    <h4>Resultado da conversão
                        <a class="btn btn-primary" href="{{ url('list')}}" role="button" target="_blank">lista cotação</a>
                    </h4>
                    <div class="resStyle">
                        <ul id="showRes">
                            <li class="liPropriets"> Moeda de origem: BRL: <strong class="text-secondary" id="coverOrigem">-</strong></li>
                            <li class="liPropriets"> Moeda de destino: USD: <strong class="text-secondary" id="coverDestiny">-</strong></li>
                            <li class="liPropriets"> Valor para conversão: <strong class="text-secondary" id="coverValor">-</strong></li>
                            <li class="liPropriets"> Forma de pagamento: <strong class="text-secondary" id="methodPayment">-</strong></li>
                            <li class="liPropriets"> Valor da "Moeda de destino" usado para conversão: <strong class="text-secondary" id="valCurrencyDestiny">-</strong></li>
                            <li class="liPropriets"> Valor comprado em "Moeda de destino": <strong class="text-secondary" id="valBuyedDestiny">-</strong></li>
                            <li class="liPropriets"> Taxa de pagamento: <strong class="text-secondary" id="ratePaymentMethod">-</strong></li>
                            <li class="liPropriets"> Taxa Conversão maior menor: <strong class="text-secondary" id="rateConversion">-</strong></li>
                            <li class="liPropriets"> Valor utilizado para conversão descontando as taxas: <strong class="text-secondary" id="valDiscontOfTypePay">-</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="module">
        $(function() {
            $('#target_value').maskMoney();
        })

        import request from "{{asset('js/axios.js')}}";
        import config from "{{asset('js/axios.js')}}";

        //Base Url api/v1/ after use only endpoints
        const getCongig = config("{{ url('api/v1/')}}");

        var cfgAxioRequest = axios.create({
            baseURL: "{{ url('api/v1/')}}",
            timeout: 1000,
            headers: {
                'Accept': 'application/json',
                'Authorization': 'bearer' + localStorage.getItem('token_gio')
            }
        });

        cfgAxioRequest({
            method: 'GET',
            url: "/awesomeapiAll",
        }).then(function(response) {
            console.log(response);

            Object.keys(response.data).forEach(function(key, offset) {

                let volate = {
                    'type': response.data[key].code,
                    'ask': response.data[key].ask,
                    'bid': response.data[key].bid,
                    'high': response.data[key].high,
                    'low': response.data[key].low
                };

                let elementCurrency = document.getElementById('targetSelect');
                const createSelect = document.createElement("option");

                createSelect.innerText = response.data[key].code;
                createSelect.value = JSON.stringify(volate);
                elementCurrency.appendChild(createSelect);

            });

        }).catch(err => {
            alert("Api Falhou, motivo desconhecido ainda! F5" + "\n" + "Veja o console, isso já aconteceu algumas vezes, tente esperar um pouco" +
                "Se necessário confere a imagem para ver, https://i.imgur.com/tuFKcIy.png talves seja o axio CDN externo.")
            console.log(err)
        });

        //payment-method
        var value_pay = 0;
        let elpaymentMethod = document.getElementById('paymentMethod');
        elpaymentMethod.addEventListener('change', function() {
            var inter_pay = this.options[this.selectedIndex].value;
            value_pay = JSON.parse(inter_pay);
            console.log(value_pay);
        });

        //currency
        var value_currency = 0;
        let elementCurrency = document.getElementById('targetSelect');
        elementCurrency.addEventListener('change', function() {
            var inter_currency = this.options[this.selectedIndex].value;
            value_currency = JSON.parse(inter_currency);
            console.log(value_currency);
        });

        setInterval(function() {

            let valBoleto = document.getElementById('inputBoleto').value;
            let valCard = document.getElementById('inputCard').value;

            let boleto = '{"val": "' + valBoleto + '","type":"boleto"}';
            let card = '{"val":"' + valCard + '","type":"card"}';

            let boletoHtml = 'Boleto, taxa de ' + valBoleto + '%';
            let cardHtml = 'Boleto, taxa de ' + valCard + '%';

            let insertBoleto = document.getElementById('boleto')
            insertBoleto.innerHTML = boletoHtml;
            insertBoleto.value = boleto;

            let insertCard = document.getElementById('card')
            insertCard.innerHTML = cardHtml;
            insertCard.value = card;

            //value
            var input = document.getElementById('target_value');
            let formatedVAl = input.value;
            let unformated = formatedVAl.replaceAll(",", "");

            let dataToConvert = {
                inputValue: undefined,
                methodPayment: undefined,
                currency: undefined,
            };

            dataToConvert.inputValue = unformated;
            dataToConvert.methodPayment = value_pay;
            dataToConvert.currency = value_currency;

            AlertConditional(formatedVAl, unformated, function(action) {
                if (action.active() == true) {
                    input.style.backgroundColor = "#CC0000";
                    input.style.color = "white";
                } else {

                    input.style.backgroundColor = "green";
                    input.style.color = "white";

                    if (!dataToConvert.methodPayment == 0 && !dataToConvert.currency == 0) {

                        // send request
                        getCongig({
                            method: 'POST',
                            url: (1) ? "/convert" : "{{ url('api/v1/convert')}}",
                            data: {
                                price: dataToConvert.inputValue,
                                md_payment: dataToConvert.methodPayment,
                                product_cur: dataToConvert.currency
                            }
                        }).then(function(response) {

                            console.log(response);
                            Object.keys(response.data).forEach(function(key, offset) {

                                if (key == 'cur_origim') document.getElementById('coverOrigem').innerHTML = response.data[key];
                                if (key == 'cur_destiny') document.getElementById('coverDestiny').innerHTML = response.data[key];
                                if (key == 'val_input') document.getElementById('coverValor').innerHTML = response.data[key];
                                if (key == 'mhd_payment') document.getElementById('methodPayment').innerHTML = response.data[key];
                                if (key == 'val_cur_destiny') document.getElementById('valCurrencyDestiny').innerHTML = response.data[key];
                                if (key == 'val_buy') document.getElementById('valBuyedDestiny').innerHTML = response.data[key];
                                if (key == 'rate_payment') document.getElementById('ratePaymentMethod').innerHTML = response.data[key];
                                if (key == 'rate_conversion') document.getElementById('rateConversion').innerHTML = response.data[key];
                                if (key == 'discont_onversion') document.getElementById('valDiscontOfTypePay').innerHTML = response.data[key];

                            });

                        }).catch(err => console.log(err));

                    }
                }
            });

            console.log(dataToConvert);

        }, 1000)

        function AlertConditional(formatedVAl, valCalculater, callback) {
            if (formatedVAl.length > 0) {
                let info_module = {
                    msg: undefined,
                    active() {
                        if (this.msg != undefined)
                            return true;
                        else return false;
                    },
                };
                if (valCalculater < 1000.00) {
                    info_module.msg = "Valor menor que" + formatedVAl + " not allowed";
                    callback(info_module);
                } else {
                    if (valCalculater > 100000.00) {
                        info_module.msg = "Valor maior que " + formatedVAl + " not allowed";
                        callback(info_module);
                    } else if (valCalculater <= 100000.00 && valCalculater >= 1000.00) {
                        info_module.msg = undefined;
                        callback(info_module);
                    }
                }
            }
        }

        var currentdate = new Date();
        var datetime = currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear();
        document.getElementById('dataCota').value = datetime;
    </script>

</body>

</html>