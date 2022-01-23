@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <form method="POST" action="{{ route('generateQuote') }}">
                    @csrf
                    <div class="card-header text-center">Conversor de Moedas</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label>Converter de:</label>
                                <select id="origin-currency"
                                        data-show-content="true"
                                        class="form-control bg-primary text-white">
                                    <option>Real Brasileiro (BRL)</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label>Insira o valor (R$):</label>
                                <input id="money" type="text" name="money" class="form-control"
                                       placeholder="R$10,00" maxlength="10" autofocus required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label>Para:</label>
                                <select name="destination-currency"
                                        id="destination-currency"
                                        data-show-content="true"
                                        class="form-control bg-primary text-white">
                                    <option value="empty">Selecione</option>
                                    @foreach ($data as $d)
                                        <option
                                            value="{{ $d['prefix'] }}"
                                        >
                                            {{ $d['label'] }} ({{ str_replace('-BRL', '', $d['prefix']) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-left text-justify d-flex justify-content-between align-items-baseline">
                                <label>Forma de Pagamento: </label>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-primary text-center">
                                        <input type="radio" name="credit-card"
                                               id="credit-card" autocomplete="off">Cartão de Crédito
                                    </label>

                                    <label class="btn btn-primary text-center">
                                        <input type="radio" name="bank-invoice"
                                               id="bank-invoice" autocomplete="off">Boleto
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 justify-content-center">
                            <button class="btn btn-primary btn-block mr-2 ml-2" id="getForm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                </svg>
                                Gerar Cotação
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    window.onload = function () {
        var element = document.getElementById('money');
        var button = document.getElementById('getForm');

        element.addEventListener('keyup', () => {
            var value = element.value;

            value = value + '';
            value = parseInt(value.replace(/[\D]+/g, ''));
            value = value + '';
            value = value.replace(/([0-9]{2})$/g, ",$1");

            if (value.length > 6) {
                value = value.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
            }

            element.value = value;
            if(value == 'NaN') element.value = '';
        });
    }




</script>
