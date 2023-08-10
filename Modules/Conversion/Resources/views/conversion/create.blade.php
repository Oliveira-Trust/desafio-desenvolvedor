@extends('user::layouts.default')

@section('content')
    <div class="row row-m-1">
        <div class="col">
            {!! Form::open(['route' => 'conversion::conversion.store', 'method' => 'post' ,'class' => 'submit-ajax']) !!}
            <div class="rbox rbox-p-0">
                <div class="rbox-body content-fields">
                    @include('baseadminlte3::layouts.partials.message')
                    <x-baseadminlte::inputs.select name="currency_destiny" label="Moeda de Destino" :options="$currencyTypes" :object="false" placeholder="Selecione" div-class="col-sm-3" :required="true"/>
                    <x-baseadminlte::inputs.text name="value" label="Valor para Conversão" :placeholder="$currencyOrigin" input-class="money" :required="true" div-class="col-md-3"/>
                    <x-baseadminlte::inputs.select name="payment_type_id" label="Forma de Pagamento" :options="$paymentTypes" :object="false" placeholder="Selecione" div-class="col-sm-3" :required="true"/>
                </div>
                <div class="rbox-footer">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('conversion::conversion.index') }}" class="btn btn-default btn-flat disable-link" role="button"><i class="fa fa-arrow-left"></i> Voltar</a>
                        </div>
                        <div class="col-auto">
                            {!! Form::submit('Salvar', ['id'=>'btn-save','data-load2'=>'Salvando...','class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
