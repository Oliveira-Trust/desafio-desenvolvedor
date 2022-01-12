@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cotações</div>

                @if(count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Erro</h4>
                    @foreach ($errors->all() as $error)
                        <li class="mb-0">
                            {{ $error }}
                        </li>
                    @endforeach
                    </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-body">
                        {!! Form::open(['route' => ['price.store'], 'method'=>'POST']) !!}
                            <div class="row">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        {{ Form::label('amount', 'Quantia a ser convertida', ['class' => 'control-label']) }}
                                        {!! Form::text('amountWithMask', null,  ['class' => 'form-control', 'required' => 'required', 'id' => 'amountWithMask', 'onBlur' => 'numberToReal(this)', 'onFocus' => 'zeroField(this)' ]) !!}
                                        {!! Form::hidden('amount', null, ['required' => 'required', 'id' => 'amount']) !!}
                                    </div>
                                </div>

                                <div class=" col-md-4 col-sm-12">
                                    <div class="form-group">
                                        {{ Form::label('targetCurrency', 'Moeda destino', ['class' => 'control-label']) }}
                                        {!! Form::select('targetCurrency', $currencyCodes, null,  ['class' => 'form-control', 'required' => 'required', 'id' => 'targetCurrency' ]) !!}
                                    </div>
                                </div>

                                <div class=" col-md-4 col-sm-12">
                                    <div class="form-group">
                                        {{ Form::label('paymentMethod', 'Método de pagamento', ['class' => 'control-label']) }}
                                        {!! Form::select('paymentMethod', $paymentTypes, null,  ['class' => 'form-control', 'required' => 'required', 'id' => 'paymentMethod' ]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-md-6 col-sm-12 mt-3">
                                    {!! Form::submit('Fazer cotação', ['class' => 'btn btn-success mr-1 mb-1']) !!}
                                    @if($userType == 'admin')
                                        <a href="{{route('fee.index')}}">
                                            <button type="button" class="btn btn-info mr-1 mb-1">Editar taxas</button>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        {!! Form::close()  !!}
                    </div>


                    @if(session('success'))
                        <hr>
                        <div class="form-body">
                            <div class="alert alert-success" role="success">
                                <p class="mb-0">
                                    {{ session('success') }}
                                </p>
                            </div>
                            <div class="row">
                                <div class="list-group">
                                    <ul>
                                        <li>
                                            Moeda de origem: <b>{{ $data['originCurrency'] }}</b>
                                        </li>
                                        <li>
                                            Moeda de destino: <b>{{ $data['targetCurrency'] }}</b>
                                        </li>
                                        <li>
                                            Valor para conversão: <b>{{ number_format($data['amountToConvert'], 2,".",",") }}</b>
                                        </li>
                                        <li>
                                            Forma de pagamento: <b>{{ $data['paymentMethod'] }}</b>
                                        </li>
                                        <li>
                                            Valor da Moeda de destino usado para conversão: <b>{{ $data['targetCurrency'] }}  {{ $data['targetCurrencyPrice'] }}</b>
                                        </li>
                                        <li>
                                            Valor comprado em Moeda de destino: <b>{{ $data['targetCurrency'] }} {{ number_format($data['amountBought'], 2,".",",") }}</b>
                                        </li>
                                        <li>
                                            Taxa de método de pagamento: <b>{{ $data['originCurrency'] }} {{ number_format($data['paymentFee'], 2,".",",") }}</b>
                                        </li>
                                        <li>
                                            Taxa de serviço: <b>{{ $data['originCurrency'] }} {{ number_format($data['defaultServiceFee'], 2,".",",") }}</b>
                                        </li>
                                        <li>
                                            Valor utilizado para conversão descontando as taxas: <b>{{ $data['originCurrency'] }} {{ number_format($data['amountUsedAfterTaxes'], 2,".",",") }}</b>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('amount').value = ''
        document.getElementById('amountWithMask').value = ''
    });

    var formatter = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    });

    function numberToReal(v) {
        document.getElementById('amount').value = v.value
        v.value = formatter.format(v.value)
    }

    function zeroField(v) {
        document.getElementById('amount').value = ''
        v.value = ''
    }

    </script>
@endsection
