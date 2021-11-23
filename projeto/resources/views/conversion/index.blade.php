@extends('layout.default')

@section('content')

    <div style=" width: 60%; margin: 50px auto">
        <div style="text-align: right; margin-bottom: 20px;">
            <a href="{{ route('logout') }}" role="button" class="btn btn-secondary">Sair</a>
        </div>

        @if (session()->has('errorMessage'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('errorMessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('successMessage'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('successMessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form class="form-horizontal" method="post" action="{{ route('conversion') }}">
            @csrf
            <div class="row">
                <div class="mb-3 row">
                    <label for="moedaOrigem" class="col-sm-2 control-label">Moeda origem</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="moedaOrigem" value="Real brasileiro" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="moedaDestino" class="col-sm-2 control-label">Moeda destino</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="moedaDestino" required>
                            <option value="">Selecione</option>
                            <option value="USD-BRL">Dólar americano</option>
                            <option value="EUR-BRL">Euro</option>
                            <option value="GBP-BRL">Libra</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="valor" class="col-sm-2 control-label">Valor a ser convertido</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="valor" placeholder="Informe o valor a ser convertido" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="formaPagto" class="col-sm-2 control-label">Forma de pagamento</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="formaPagto" required>
                            <option value="">Selecione</option>
                            <option value="boleto">Boleto</option>
                            <option value="credito">Cartão Crédito</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Converter</button>

            </div>
        </form>

        @if(isset($data))
            <strong>Moeda de origem: </strong><span>Real brasileiro</span><br>
            <strong>Moeda de destino: </strong><span>{{ $data['moedaDestino'] }}</span><br>
            <strong>Valor para conversão: </strong><span>{{ $data['valor'] }}</span><br>
            <strong>Forma pagamento: </strong><span>{{ $data['formaPagto'] }}</span><br>
            <strong>Valor da cotação: </strong><span>{{ $data['valorMoedaDestino'] }}</span><br>
            <strong>Valor comprado: </strong><span>{{ $data['valorComprado'] }}</span><br>
            <strong>Taxa de pagamento: </strong><span>{{ $data['taxaPagto'] }}</span><br>
            <strong>Taxa de conversão: </strong><span>{{ $data['taxConversion'] }}</span><br>
            <strong>Valor utilizado para conversão descontando as taxas: </strong><span>{{ $data['valorTotalDescontado'] }}</span><br><br>

            <span>Deseja enviar por email?</span>
            <form class="form-horizontal" method="post" action="{{ route('sendMail') }}">
                @csrf
                <input type="hidden" name="moedaDestino" value="{{ $data['moedaDestino'] }}">
                <input type="hidden" name="valor" value="{{ $data['valor'] }}">
                <input type="hidden" name="formaPagto" value="{{ $data['formaPagto'] }}">
                <input type="hidden" name="valorMoedaDestino" value="{{ $data['valorMoedaDestino'] }}">
                <input type="hidden" name="valorComprado" value="{{ $data['valorComprado'] }}">
                <input type="hidden" name="taxaPagto" value="{{ $data['taxaPagto'] }}">
                <input type="hidden" name="taxConversion" value="{{ $data['taxConversion'] }}">
                <input type="hidden" name="valorTotalDescontado" value="{{ $data['valorTotalDescontado'] }}">
                <div class="mb-3 row">
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="mail" placeholder="Digite seu email">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        @endif
    </div>

@endsection


