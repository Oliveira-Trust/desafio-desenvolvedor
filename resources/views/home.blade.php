@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">Conversor de Moedas</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <select id="origin-currency"
                                    data-show-content="true"
                                    class="form-control bg-primary text-white"
                            >
                                <option>Real Brasileiro (BRL)</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <input id="money" type="text" class="form-control"
                                   name="money"
                                   placeholder="R$10,00"
                                   autofocus
                                   maxlength="10"
                            >
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <select id="destiny-currency"
                                    data-show-content="true"
                                    class="form-control bg-primary text-white">
                                <option value="empty">Selecione</option>
                                @foreach ($data as $d)
                                    <option
                                        value="{{ $d['prefix'] }}"
                                    >
                                        {{ $d['label'] }}({{ str_replace('-BRL', '', $d['prefix']) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
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
