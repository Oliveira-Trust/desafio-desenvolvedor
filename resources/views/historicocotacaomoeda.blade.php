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
    <title>Histórico de Cotações</title>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scriptChamadas.js') }}"></script>

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
                        <a class="nav-link active" aria-current="page" href= {{route('conversao')}} >Conversor de Valores</a>
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
            <div class="offset-3 col-6 ">
                <div class="card mt-5">
                    <div class="card-header bg-success text-white">
                        <b>Histórico de Cotações</b>
                    </div>

                    <div class="card-body">

                        <table class="table table-hover" id="cotacoes">
                            <thead>
                                <tr>
                                    <th scope="col">Moeda de Origem</th>
                                    <th scope="col">Moeda de Destino</th>
                                    <th scope="col">Valor da Moeda</th>
                                    <th scope="col">Data Cotação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cotacoes as $cotacao)
                                    <tr>
                                        <td>{{ $cotacao->moeda_origem }}</td>
                                        <td>{{ $cotacao->moeda_destino }}</td>
                                        <td>{{ $cotacao->valor_moeda_destino }}</td>
                                        <td>{{ $cotacao->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
        </div>



    </div>
</body>

</html>
