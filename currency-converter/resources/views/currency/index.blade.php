@extends('layouts.app')

@section('title', 'Currency Converter')

@section('content')
    <h1>Conversor de Moedas</h1>

    <!-- Formulário de conversão -->
    <form action="{{ route('convert') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="currency">Moeda de destino:</label>
            <select class="form-control" id="currency" name="currency">
                <option value="USD">USD</option>
                <option value="BTC">BTC</option>
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Valor para conversão (BRL):</label>
            <input type="number" class="form-control" id="amount" name="amount" min="1000" max="100000" required>
        </div>

        <div class="form-group">
            <label for="payment_method">Forma de pagamento:</label>
            <select class="form-control" id="payment_method" name="payment_method">
                <option value="boleto">Boleto</option>
                <option value="credit_card">Cartão de Crédito</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Converter</button>
    </form>

    <!-- Seção de histórico -->
    <h2>Histórico de Cotações</h2>
    @if($histories->isEmpty())
        <p>Sem histórico de cotações.</p>
    @else
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Moeda de Origem</th>
                    <th>Moeda de Destino</th>
                    <th>Valor</th>
                    <th>Método de Pagamento</th>
                    <th>Taxa de Câmbio</th>
                    <th>Valor Convertido</th>
                    <th>Taxa de Pagamento</th>
                    <th>Taxa de Conversão</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                <tr>
                    <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $history->source_currency }}</td>
                    <td>{{ $history->target_currency }}</td>
                    <td>R$ {{ number_format($history->amount, 2, ',', '.') }}</td>
                    <td>{{ $history->payment_method == 'boleto' ? 'Boleto' : 'Cartão de Crédito' }}</td>
                    <td>R$ {{ number_format($history->exchange_rate, 2, ',', '.') }}</td>
                    <td>$ {{ number_format($history->converted_amount, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($history->payment_fee, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($history->conversion_fee, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
