@extends('layouts.app')

@section('content')

    <style>
        main {
            min-width: 100%;
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
        }

        h1 {
            margin-bottom: 2vh;
        }

        .content, .historico {
            min-width: 100%;
            min-height: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            background-color: white;

            padding: 2vh 1vw;

            -webkit-box-shadow: 4px 4px 12px -3px #000000;
            box-shadow: 4px 4px 12px -3px #000000;
        }

        .historico {
            flex-direction: column;
            margin-top: 2vh;
        }

        td, tr {
            text-align: center;
        }
    </style>

    <main>
        <h1>Sistema de Conversão de Moeda</h1>
        <div class="content">
            <div class="formulario-conversao">
                <fieldset>
                    <legend>Conversão</legend>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="form-conversao-moeda" method="POST" action="{{ route('conversao') }}">
                        @csrf
                        <div class="">
                            <label for="moeda-destino">Moeda de destino</label>
                            <select class="form-select" id="moeda-destino" name="moeda-destino">
                                <option {{ isset($dados['moeda-destino']) ? '' : 'selected' }} value="0">Selecione uma opção</option>
                                <option {{ isset($dados['moeda-destino']) && $dados['moeda-destino'] == "1" ? 'selected' : '' }} value="1">USD - Dólar Americano</option>
                                <option {{ isset($dados['moeda-destino']) && $dados['moeda-destino'] == "2" ? 'selected' : '' }} value="2">EUR - Euro</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="valor-conversao">Valor para conversão (BRL - Real Brasileiro)</label>
                            <input
                                type="number"
                                name="valor-conversao"
                                class="form-control"
                                id="valor-conversao"
                                value="{{ isset($dados['valor-conversao']) ? $dados['valor-conversao'] : '' }}"
                            >
                        </div>
                        <div class="">
                            <label for="forma-pagamento">forma de pagamento</label>
                            <select class="form-select" id="forma-pagamento" name="forma-pagamento">
                                <option {{ isset($dados['forma-pagamento']) ? '' : 'selected' }} value="0">Selecione uma opção</option>
                                <option {{ isset($dados['forma-pagamento']) && $dados['forma-pagamento'] == "1" ? 'selected' : '' }} value="1">Boleto</option>
                                <option {{ isset($dados['forma-pagamento']) && $dados['forma-pagamento'] == "2" ? 'selected' : '' }} value="2">Cartão de Crédito</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Converter</button>
                    </form>
                </fieldset>
            </div>
            <div class="resultado">
                <fieldset class="resultado-conversao">
                    <legend>Resultado</legend>

                    <div class="">
                        <label>Moeda de origem: </label>
                        <span class="form-control" id="resultado-moeda-origem" disabled>{{ isset($dados['moeda_origem']) ? $dados['moeda_origem'] : '' }}</span>
                    </div>

                    <div class="">
                        <label>Moeda de destino: </label>
                        <span class="form-control" id="resultado-moeda-destino" disabled>{{ isset($dados['moeda_destino']) ? $dados['moeda_destino'] : '' }}</span>
                    </div>

                    <div class="">
                        <label>Valor para conversão: </label>
                        <span class="form-control" id="resultado-valor-conversao" disabled>{{ isset($dados['valor_conversao']) ? $dados['valor_conversao'] : '' }}</span>
                    </div>

                    <div class="">
                        <label>Forma de pagamento: </label>
                        <span class="form-control" id="resultado-forma-pagamento" disabled>{{ isset($dados['forma_pagamento']) ? $dados['forma_pagamento'] : '' }}</span>
                    </div>

                    <div class="">
                        <label>Valor da "Moeda de destino" usada para conversão: </label>
                        <span class="form-control" id="resultado-valor-moeda-destino" disabled>{{ isset($dados['valor_moeda_destino']) ? $dados['valor_moeda_destino'] : '' }}</span>
                    </div>

                    <div class="">
                        <label>Valor comprado em "Moeda de destino": </label>
                        <span class="form-control" id="resultado-valor-comprado-moeda-destino" disabled>{{ isset($dados['valor_comprado']) ? $dados['valor_comprado'] : '' }}</span>
                    </div>

                    <div class="">
                        <label>Taxa de pagamento: </label>
                        <span class="form-control" id="resultado-taxa-pagamento" disabled>{{ isset($dados['taxa_pagamento']) ? $dados['taxa_pagamento'] : '' }}</span>
                    </div>

                    <div class="">
                        <label>Taxa de conversão: </label>
                        <span class="form-control" id="resultado-taxa-pagamento" disabled>{{ isset($dados['taxa_conversao']) ? $dados['taxa_conversao'] : '' }}</span>
                    </div>

                    <div class="">
                        <label>Valor utilizado para conversão descontando as taxas: </label>
                        <span class="form-control" id="resultado-valor-convertido" disabled>{{ isset($dados['valor_converter']) ? $dados['valor_converter'] : '' }}</span>
                    </div>

                </fieldset>
            </div>
        </div>

        <h1>Histórico de Conversões</h1>
        <div class="historico">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Moeda de origem</th>
                    <th scope="col">Moeda de destino</th>
                    <th scope="col">Valor para Conversão</th>
                    <th scope="col">Forma de Pagamento</th>
                    <th scope="col">Valor da "Moeda de destino" usada para conversão</th>
                    <th scope="col">Valor comprado em "Moeda de destino"</th>
                    <th scope="col">Taxa de pagamento</th>
                    <th scope="col">Taxa de conversão</th>
                    <th scope="col">Valor utilizado para conversão descontando as taxas</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($dados['conversoes']))
                    @foreach($dados['conversoes'] as $conversao)
                        <tr>
                            <td>{{ $conversao['moeda_origem'] }}</td>
                            <td>{{ $conversao['moeda_destino'] }}</td>
                            <td>{{ $conversao['valor_conversao'] }}</td>
                            <td>{{ $conversao['forma_pagamento'] }}</td>
                            <td>{{ $conversao['valor_moeda_destino'] }}</td>
                            <td>{{ $conversao['valor_comprado'] }}</td>
                            <td>{{ $conversao['taxa_pagamento'] }}</td>
                            <td>{{ $conversao['taxa_conversao'] }}</td>
                            <td>{{ $conversao['valor_converter'] }}</td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="9">Nenhum registro foi encontrado</td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
    </main>
@endsection
