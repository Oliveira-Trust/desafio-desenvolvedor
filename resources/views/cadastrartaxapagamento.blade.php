<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <title>Taxa de Forma de Pagamento</title>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scriptChamadas.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/currency.png') }}" width="48" height="48"
                    class="d-inline-block align-top" loading="lazy">
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href={{ route('conversao') }}>Conversor de
                            Valores</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href={{ route('cadastrartaxaconversao') }}>Taxa de Conversão</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href={{ route('cadastrartaxapagamento') }}>Taxa de Pagamento</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href={{ route('historicoCotacaoMoeda') }}>Listar Cotações</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" style="margin-right: 1%;">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><img src="{{ asset('img/user.png') }}"
                                    style="width: 32px; height: 32px; border-radius: 50%;"></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">

                                @if (Auth::user())
                                    {{ Auth::user()->name }}
                                @else
                                    teste lo
                                @endif

                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">.</a></li>
                                <li><a class="dropdown-item" href="#">.</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Fazer Logoff</a></li>
                            </ul>
                        </li>
                    </ul>

                </form>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="row">
            <div class="offset-3 col-6">

                <div class="card mt-5">
                    <div class="card-header bg-success text-white">
                        <b>Cadastrar taxa de forma de pagamento</b>
                    </div>

                    <div class="card-body">
                        <form id="frmtaxapagamento" name="frmtaxapagamento" action="">
                        <label for="tipoFormaPagamento">Forma de pagamento:</label>
                        <select class="form-select  mb-3" id="tipoFormaPagamento" name="tipoFormaPagamento"
                            aria-label="Default select example" required >
                            <option selected></option>
                            <option value="1">Boleto</option>
                            <option value="2">Cartão de crédito</option>
                        </select>

                        <label for="taxa">Taxa:</label>
                        <input class="form-control mb-3" type="text" id="taxa" name="taxa" required />

                        <button class="btn btn-success mb-3" id="enviar" name="enviar" type="submit"
                            onclick="cadastrarTaxaFormaPagamento()">Cadastrar</button><br>

                        </form>

                    </div>
                </div>


            </div>
        </div>



    </div>
</body>

</html>
