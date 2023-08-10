@extends('user::layouts.default')

@section('content')
    <div class="row row-m-1">
        <div class="col">
            @if(isset($conversionTax))
                {!! Form::model($conversionTax, ['route' => ['conversion::config.tax.update', $conversionTax], 'method' => 'put' ,'class' => 'submit-ajax']) !!}
            @else
                {!! Form::open(['route' => 'conversion::config.tax.store', 'method' => 'post' ,'class' => 'submit-ajax']) !!}
            @endif

            <div class="rbox rbox-p-0">
                <div class="rbox-body content-fields">
                    @include('baseadminlte3::layouts.partials.message')
                    <x-baseadminlte::inputs.text name="min" :value="$conversionTax->min ?? null" label="Valor mínimo" input-class="money" field-length="payment_types.min" div-class="col-md-2"/>
                    <x-baseadminlte::inputs.text name="max" :value="$conversionTax->max ?? null" label="Valor Máximo" input-class="money" field-length="payment_types.max" div-class="col-md-2"/>
                    <x-baseadminlte::inputs.text name="value" :value="$conversionTax->value ?? null" label="Taxa (%)" input-class="money" field-length="payment_types.tax" :required="true" div-class="col-md-2"/>

                </div>
                <div class="rbox-footer">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('conversion::config.tax.index') }}" class="btn btn-default btn-flat disable-link" role="button"><i class="fa fa-arrow-left"></i> Voltar</a>
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
