<!DOCTYPE html>
<html>
<head>
    <title>Conversão de Moeda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch available currencies
            $.ajax({
                url: '{{ route('listarMoedas') }}',
                method: 'GET',
                success: function(data) {
                    $.each(data, function(key) {
                        $('#moeda_destino').append($('<option>', {
                            value: key,
                            text: key
                        }));
                      
                    });
                }
            });

            // Fetch exchange rate on currency selection
            $('#moeda_destino').change(function() {
                var moeda = $(this).val();
                if (moeda) {
                    $.ajax({
                        url: '/cotacao/' + moeda,
                        method: 'GET',
                        success: function(data) {
                            $('#cotacao').text('Cotação do dia: ' + data);
                        }
                    });
                } else {
                    $('#cotacao').text('');
                }
            });
        });
    </script>
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <body>
    <div class="container mt-5">
    <div class="mx-auto p-2" style="width: 500px;">
    <div class="shadow-none p-3 mb-5 bg-body-secondary rounded w-200 p-3">
        <h1 class="mb-4">Conversão de Moeda</h1>
        <form action="{{ route('converter') }}" method="POST">
        <img src="{!! asset('img/coin.svg') !!}" class="mb-4" height="57" width="72" />
            @csrf
            <div class="mb-3">
                <label for="moeda_origem" class="form-label">Moeda de Origem</label>
                <select name="moeda_origem" id="moeda_origem" class="form-select">
                    <option value="BRL">BRL</option>
                    <!-- Options will be populated by AJAX -->
                </select>
            </div>

            <div class="mb-3">
                <label for="moeda_destino" class="form-label">Moeda de Destino</label>
                <select name="moeda_destino" id="moeda_destino" class="form-select">
                    <!-- Options will be populated by AJAX -->
                </select>
            </div>

            <div class="mb-3">
                <span id="cotacao" class="form-text"></span>
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor para Conversão (BRL)</label>
                <input type="number" name="valor" id="valor" class="form-control" required min="1000" max="100000">
            </div>

            <div class="mb-3">
                <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                <select name="forma_pagamento" id="forma_pagamento" class="form-select">
                    <option value="boleto">Boleto</option>
                    <option value="cartao">Cartão de Crédito</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Converter</button>
        </form>
    </div>
    </div>
    </div>
</body>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
