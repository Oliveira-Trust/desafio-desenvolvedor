<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Compra de Moedas Internacionais</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ @asset('css/app.css')  }}">
    </head>
    <body>

        <div class="container mt-5">
            <h1 class="text-center">Compre moedas internacionais!</h1>

            <div class="app-wrapper p-4 mt-4">
                <div class="app-form">
                    <div class="form-group">
                        <label for="amount_to_convert">Valor da Compra (R$)</label>
                        <input type="text" name="amount_to_convert" id="amount_to_convert" class="form-control amount" placeholder="Digite o valor a ser pago">
                    </div>
                    <div class="form-group mt-3">
                        <label for="final_currency">Moeda desejada</label>
                        <select name="final_currency" id="final_currency" class="form-control">
                            <option value="">Selecione uma moeda...</option>
                            @foreach($currencies as $k => $v)
                                <option value="{{ $k  }}">{{ $v }} ({{ $k  }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="payment_method">Método de pagamento*</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                            <option value="">Selecione um método de pagamento...</option>
                            <option value="bank_payment">Boleto Bancário</option>
                            <option value="credit_card">Cartão de Crédito</option>
                        </select>
                    </div>

                    <a href="#" class="btn btn-success buy-currency d-block mt-4">Comprar!</a>
                </div>
                <div class="app-result mt-5 d-none"></div>
                <div class="app-errors mt-5 d-none"></div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-latest.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
        <script src="{{ @asset('js/app.js')  }}"></script>
    </body>
</html>
