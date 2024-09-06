@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Painel Administrativo') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Taxas de conversão:</h3>
                    <form action="{{ route('painel.update') }}" method="post">
                        @csrf
                        @method('post')

                        <div class="mb-2">
                            <label class="form-label" id="taxa_conv_abaixo" for="taxa_conv_abaixo">Taxa de conversão (Abaixo de R$3000) </label>
                            <input class="form-control percent" name="taxa_conv_abaixo" value="{{ $config->taxa_conv_abaixo }}" maxlength="7" />
                        </div>

                        <div class="mb-5">
                            <label class="form-label" id="taxa_conv_acima" for="taxa_conv_acima">Taxa de conversão (Acima de R$3000) </label>
                            <input class="form-control percent" name="taxa_conv_acima" value="{{ $config->taxa_conv_acima }}" />
                        </div>

                        <h3>Taxas de pagamento:</h3>

                        <div class="mb-2">
                            <label class="form-label" id="taxa_boleto" for="taxa_boleto">Taxa de pagamento (Boleto Bancário) </label>
                            <input class="form-control percent" name="taxa_boleto" value="{{ $config->taxa_boleto }}"/>
                        </div>

                        <div class="mb-2">
                            <label class="form-label" id="taxa_cartao" for="taxa_cartao">Taxa de pagamento (Cartão de Crédito) </label>
                            <input class="form-control percent" name="taxa_cartao" value="{{ $config->taxa_cartao }}" />
                        </div>

                        <div class="pt-5 d-flex justify-content-between">
                            <div>
                                <a class="btn btn-danger" href="{{ route('cambio.index') }}">Voltar</a>
                            </div>
                            <div>
                                <a id="limpar_campos" class="btn btn-secondary">Limpar</a>
                                <button class="btn btn-dark" type="submit">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
