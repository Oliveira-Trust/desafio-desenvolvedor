@extends('user::layouts.default')

@section('content')
    <div class="row row-m-1">
        <div class="col">
            {!! Form::model($paymentTypes, ['route' => 'conversion::config.payment.update', 'method' => 'put' ,'class' => 'submit-ajax']) !!}

            <div class="rbox rbox-p-0">
                <div class="rbox-body content-fields">
                    @include('baseadminlte3::layouts.partials.message')
                    <div>
                        @foreach($paymentTypes as $paymentType)
                            <x-baseadminlte::inputs.text :value="$paymentType->tax" :name="'payment['.$paymentType->id.']'" :label="$paymentType->name" input-class="money" field-length="payment_types.tax" placeholder="Taxa (%)" :required="true" div-class="col-md-2"/>
                        @endforeach
                 </div>
                </div>
                <div class="rbox-footer">
                    <div class="row">
                        <div class="col">
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
