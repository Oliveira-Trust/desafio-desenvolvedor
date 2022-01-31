<!DOCTYPE html>
<html>
<head>
    <title>Conversor de moeda - Hugo Almeida</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <form id="currency-exchange-rate" action="#" method="post" class="form-group">
                <input type="hidden" name="from_currency" value="BRL"/>

                <div class="d-flex align-items-center">
                    <label class="control-label">Converter de Real brasileiro (BRL) para:</label>

                    <div class="ml-2">
                        <select name="to_currency" class="form-control">
                            <option value="BOB">Boliviano</option>
                            <option value="VEF">Bolívar Venezuelano</option>
                            <option value="XBR">Brent Spot</option>
                            <option value="CZK">Coroa Checa</option>
                            <option value="DKK">Coroa Dinamarquesa</option>
                            <option value="ISK">Coroa Islandesa</option>
                            <option value="NOK">Coroa Norueguesa</option>
                            <option value="SEK">Coroa Sueca</option>
                            <option value="AED">Dirham dos Emirados</option>
                            <option value="USD">Dólar Americano</option>
                            <option value="AUD">Dólar Australiano</option>
                            <option value="CAD">Dólar Canadense</option>
                            <option value="JMD">Dólar Jamaicano</option>
                            <option value="NZD">Dólar Neozelandês</option>
                            <option value="BSD">Dólar das Bahamas</option>
                            <option value="KYD">Dólar das Ilhas Cayman</option>
                            <option value="SGD">Dólar de Cingapura</option>
                            <option value="HKD">Dólar de Hong Kong</option>
                            <option value="EUR">Euro</option>
                            <option value="CHF">Franco Suíço</option>
                            <option value="PYG">Guarani Paraguaio</option>
                            <option value="JPY">Iene Japonês</option>
                            <option value="GBP">Libra Esterlina</option>
                            <option value="ILS">Novo Shekel Israelense</option>
                            <option value="ARS">Peso Argentino</option>
                            <option value="CLP">Peso Chileno</option>
                            <option value="COP">Peso Colombiano</option>
                            <option value="CUP">Peso Cubano</option>
                            <option value="MXN">Peso Mexicano</option>
                            <option value="UYU">Peso Uruguaio</option>
                            <option value="ZAR">Rand Sul-Africano</option>
                            <option value="RUB">Rublo Russo</option>
                            <option value="MVR">Rufiyaa Maldiva</option>
                            <option value="IDR">Rupia Indonésia</option>
                            <option value="INR">Rúpia Indiana</option>
                            <option value="PEN">Sol do Peru</option>
                            <option value="KRW">Won Sul-Coreano</option>
                            <option value="CNY">Yuan Chinês</option>
                            <option value="CNH">Yuan chinês offshore</option>
                        </select>
                    </div>

                    <label class="control-label ml-4">Forma de pagamento:</label>
                    <div class="ml-2">
                        <select name="payment_mode" class="form-control">
                            <option value="boleto">Boleto</option>
                            <option value="cartao">Cartão de Crédito</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex mb-3 align-items-center">
                    <label class="control-label" class="">Valor:</label>
                    <div class="ml-2">
                        <input type="text" name="amount" id="amount" class="form-control mt-4" value="1">
                        <span class="small text-danger">Valor entre R$ 1.000,00 e R$ 100.000,00</span>
                    </div>

                    <div class="ml-2">
                        <input type="submit" name="submit" id="btnSubmit" class="btn btn-primary " value="Converter">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer" id="output">
            {{--<div>--}}
                {{--<span class="h5">Moeda de origem:</span>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<span class="h5">Moeda de destino:</span>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<span class="h5">Valor para conversão:</span>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<span class="h5">Forma de pagamento:</span>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<span class="h5">Valor usado para conversão:</span>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<span class="h5">Valor comprado (com taxas):</span>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<span class="h5">Taxa de pagamento:</span>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<span class="h5">Taxa de conversão:</span>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<span class="h5">Valor para conversão (descontado as taxas):</span>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btnSubmit").click(function (event) {

            event.preventDefault();

            var form = $('#currency-exchange-rate')[0];

            var data = new FormData(form);

            let amount = document.getElementById('amount').value;
            if(parseFloat(amount) < 1000 || parseFloat(amount) > 100000){
                alert('Valor deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00');
                return;
            }

            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                type: "POST",
                url: "{{ url('currency') }}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
                success: function (data) {
                    $("#output").html(data);
                    $("#btnSubmit").prop("disabled", false);
                },
                error: function (e) {
                    $("#output").html(e.responseText);
                    console.log("ERROR : ", e);
                    $("#btnSubmit").prop("disabled", false);
                }
            });
        });
    });
</script>
</body>
</html>
