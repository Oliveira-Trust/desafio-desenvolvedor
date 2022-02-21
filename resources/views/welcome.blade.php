<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Styles -->

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="container">

        <header>
            <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills float-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <input type="submit" class="dropdown-item"  value="Sair" />
                            </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            </div>
        </header>

        <section>
            <div class="card">
                <h5 class="card-header">Cadastro</h5>
                <div class="card-body">

                    <form action="{{ route('cadastro_moeda') }}" method="POST">
                        @csrf
                        <label for="moeda_destino">Moeda de Destino</label>
                        <select class="form-control" name="moeda_destino" value="{{ old('moeda_destino') }}">
                            <option value="USD">Dólar</option>
                            <option value="EUR">Euro</option>
                        </select>

                        <label for="valor_conversao">Valor para Conversão</label>
                        <input type="text" class="form-control" value="{{ old('valor_conversao') }}" name="valor_conversao" placeholder="500000, 1000, 70000.00, ...">

                        <label for="forma_pagamento">Forma de Pagamento</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="forma_pagamento" {{ old('forma_pagamento') == 1 ? 'checked' : '' }} id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">Boleto</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="forma_pagamento" {{ old('forma_pagamento') == 2 ? 'checked' : '' }} id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">Cartão de Crédito</label>
                        </div>

                        <div class="float-end">
                            <input type="submit" class="btn btn-success" value="Cadastrar">
                        </div>

                    </form>

                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach

                    @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>

            <div class="card mt-2">
                <h5 class="card-header">Histórico de cotações</h5>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Moeda de origem</td>
                            <td>Moeda de destino</td>
                            <td>Valor para conversão</td>
                            <td>Forma de pagamento</td>
                            <td>Valor da "Moeda de destino" usado para conversão</td>
                            <td>Valor comprado em "Moeda de destino"</td>
                            <td>Taxa de pagamento</td>
                            <td>Taxa de conversão</td>
                            <td>Valor utilizado para conversão descontando as taxas</td>
                            <td>Criado em</td>
                        </tr>
                        @foreach ($historicos_cotacoes as $item)
                            <tr>
                                <td>BRL</td>
                                <td>{{ $item->moeda_destino }}</td>
                                <td>R$ {{ $item->valor_conversao }}</td>
                                <td>{{ $item->forma_pagamento }}</td>
                                <td>{{ $item->valor_moeda_destino }}</td>
                                <td>{{ $item->valor_comprado_moeda_destino }}</td>
                                <td>R$ {{ $item->taxa_pagamento }}</td>
                                <td>R$ {{ $item->taxa_conversao }}</td>
                                <td>R$ {{ $item->valor_conversao_desconto_taxas }}</td>
                                <td>{{ $item->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </section>
    </body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
