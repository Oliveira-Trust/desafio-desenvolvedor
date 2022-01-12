@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    {{ Form::label('amount', 'Quantia a ser convertida', ['class' => 'control-label']) }}
                                    {!! Form::text('amount', null,  ['class' => 'form-control', 'required' => 'required', 'id' => 'amount' ]) !!}
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    {{ Form::label('originalCurrency', 'Moeda original', ['class' => 'control-label']) }}
                                    {!! Form::select('originalCurrency', ['L' => 'Large', 'S' => 'Small'], null,  ['class' => 'form-control', 'required' => 'required', 'id' => 'originalCurrency' ]) !!}
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    {{ Form::label('targetCurrency', 'Moeda destino', ['class' => 'control-label']) }}
                                    {!! Form::select('targetCurrency', ['L' => 'Large', 'S' => 'Small'], null,  ['class' => 'form-control', 'required' => 'required', 'id' => 'targetCurrency' ]) !!}
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    {{ Form::label('paymentMethod', 'Método de pagamento', ['class' => 'control-label']) }}
                                    {!! Form::select('paymentMethod', ['L' => 'Large', 'S' => 'Small'], null,  ['class' => 'form-control', 'required' => 'required', 'id' => 'paymentMethod' ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <button type="button" class="btn btn-success mr-1 mb-1" onclick="storeNewCategory()">Salvar</button>
                            </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
