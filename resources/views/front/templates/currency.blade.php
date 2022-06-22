@extends('front.partials.app')

@section('title', 'Página Inicial')

@section('section-title', 'Conversor de Moedas')

@section('section-description', 'Faça a conversão de moedas selecionando a forma de pagamento, e a moeda de destino')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('front.partials.layout.flash-messages')
                @include('front.templates.currency-result')

                <form method="post" action="{{ route('currency.calculate-conversion') }}">
                    @csrf

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="value" class="form-label">Valor (BRL)</label>
                            <input type="text" name="value" class="form-control money-mask" id="value" placeholder="0,00" required="required">
                        </div>

                        <div class="col-md-5">
                            <label for="currency" class="form-label">Moeda</label>
                            <select class="form-select" id="currency" name="currency" required="required">
                                @foreach($availableCurrencies as $code)
                                    <option value="{{ $code }}" {{ $code == 'USD' ? 'selected' : '' }}>{{ $code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="payment_method" class="form-label">Forma de Pagamento</label>
                            <select class="form-select" id="payment_method" name="payment_method" required="required">
                                @foreach ($availablePaymentMethods as $key => $value)
                                    <option value="{{ $key }}">{{ $value['display_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-danger btn-lg" type="submit">Converter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
