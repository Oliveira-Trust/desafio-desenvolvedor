@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Configurações de Taxa</div>
                <div class="card-body">
                    <form action="{{ route('settings.update', $setting->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="ticket_tax" class="form-label">Taxa de Pagamento - Boleto (%)</label>
                            <input type="text" name="ticket_tax" value="{{ $setting->ticket_tax }}" class="form-control" id="ticket_tax">
                        </div>

                        <div class="mb-3">
                            <label for="credit_card_tax" class="form-label">Taxa de Pagamento - Cartão de Crédito (%)</label>
                            <input type="text" name="credit_card_tax" value="{{ $setting->credit_card_tax }}" class="form-control" id="credit_card_tax">
                        </div>

                        <div class="mb-3">
                            <label for="conversion_tax_start" class="form-label">Taxa de Conversão - Valor <= 3000 (%)</label>
                            <input type="text" name="conversion_tax_start" value="{{ $setting->conversion_tax_start }}" class="form-control" id="conversion_tax_start">
                        </div>

                        <div class="mb-3">
                            <label for="conversion_tax_end" class="form-label">Taxa de Conversão - Valor > 3000 (%)</label>
                            <input type="text" name="conversion_tax_end" value="{{ $setting->conversion_tax_end }}" class="form-control" id="conversion_tax_end">
                        </div>

                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
