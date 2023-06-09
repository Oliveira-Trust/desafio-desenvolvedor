@extends('layouts.common.main')

@section('title', 'Converter Real Brasileiro')

@section('content')
    <div class="col-md-6">
        <h1 class="text-center">Converter Real Brasileiro</h1>
        <form action="{{route('converter.make')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="destination_currency">Moeda de Destino</label>
                <select name="destination_currency" id="destination_currency" class="form-control" required>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
                @if ($errors->get('destination_currency'))
                    @include('components.common.input-errors', [
                        'errors' => $errors->get('destination_currency'),
                    ])
                @endif
            </div>

            <div class="mb-3">
                <label for="value_to_convert" class="form-label">Valor para Conversão</label>
                <input type="text" name="value_to_convert" class="form-control" id="value_to_convert" value=""
                    required onkeypress="$(this).mask('#.##0,00', {reverse: true});">
                @if ($errors->get('value_to_convert'))
                    @include('components.common.input-errors', [
                        'errors' => $errors->get('value_to_convert'),
                    ])
                @endif
            </div>

            <div class="mb-3">
                <label for="payment_method">Forma de Pagamento</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="boleto">Boleto</option>
                    <option value="credit_card">Cartão de Crédito</option>
                </select>
                @if ($errors->get('payment_method'))
                    @include('components.common.input-errors', [
                        'errors' => $errors->get('payment_method'),
                    ])
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Converter</button>
            </div>
        </form>
    </div>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
@endsection
