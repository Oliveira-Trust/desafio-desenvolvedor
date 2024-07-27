<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversão de Moeda</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container-fluid pt-5 ">
        <div class="row justify-content-center">
            <div class="col-7 text-center pb-5">
                <h1>Conversão de Moeda</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <form id="conversion-form" action="/conversion" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="from_currency">Moeda de Origem</label>
                        <input value="BRL" readonly name="from_currency" id="from" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="to_currency">Moeda de Destino</label>
                        <select name="to_currency" id="to_currency" class="form-control" required>
                            <option value="">Selecione a moeda</option>
                            <option value="USD">USD - Dólar Americano</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="BTC">BTC - Bitcoin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Valor para Conversão</label>
                        <input type="number" name="amount" id="amount" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Forma de Pagamento</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="">Selecione</option>
                            <option value="ticket">Boleto</option>
                            <option value="credit_card">Cartão de Crédito</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Converter</button>
                </form>
            </div>
            <div class="col-3">
                <img id="rm-img" src="https://cdn-icons-png.flaticon.com/512/3309/3309991.png" width="350px"/>
                <div id="success-message" class="alert alert-success d-none mt-3"></div>
                <div id="error-message" class="alert alert-danger d-none mt-3"></div>
            </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-7 pt-5">
                    <h5>Histórico de cotações feita pelo usuário</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Origem</th>
                                <th scope="col">Destino</th>
                                <th scope="col">Valor para conversão</th>
                                <th scope="col">Forma de pagamento</th>
                                <th scope="col">Valor conversão</th>
                                <th scope="col">Valor menos taxas</th>
                                <th scope="col">Taxa de pagamento</th>
                                <th scope="col">Taxa de conversão</th>
                                <th scope="col">Conversão descontando taxas</th>
                                </tr>
                            </thead>
                            <tbody id="conversionDataBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/conversion.js') }}"></script>
</body>
</html>
