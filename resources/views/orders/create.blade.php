@extends('layouts.app')

@section('style')
@parent
@endsection

@section('content')
<h1>{{ __('Orders') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Add Order') }}</b>
    </div>
    <div class="card-body">
        {!! Form::open(['method' => "POST", "route" => "order.store"]) !!}
        <div class="form-row mb-3">
            <div class="col-md-5 form-group">
                {!! Form::label('customer_id', __('Customer')) !!}
                {!! Form::select('customer_id', $customers, null, ['class' => "form-control select2 " . ($errors->has('customer_id') ? "is-invalid" : "")]) !!}
                @if($errors->has('customer_id')) <div class="invalid-feedback">{{ $errors->first('customer_id') }}</div> @endif
            </div>
            <div class="col-md-3">
                {!! Form::label('code', __('Code')) !!}
                {!! Form::text('code', '', ['class' => "form-control " . ($errors->has('code') ? "is-invalid" : "")]) !!}
                @if($errors->has('code')) <div class="invalid-feedback">{{ $errors->first('code') }}</div> @endif
            </div>
            <div class="col-md-2">
                {!! Form::label('status', __('Status')) !!}
                {!! Form::select('status', [
                'Opened' => __('Opened'),
                'Paid out' => __('Paid out'),
                'Canceled' => __('Canceled')
                ], '', ['class' => "form-control " . ($errors->has('status') ? "is-invalid" : "")]) !!}
                @if($errors->has('status')) <div class="invalid-feedback">{{ $errors->first('status') }}</div> @endif
            </div>
            <div class="col-md-2">
                {!! Form::label('order_total_price', __('Total order')) !!}
                {!! Form::text('order_total_price', '0,00', ['class' => "form-control", 'readonly' => true]) !!}
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <b>{{ __('Add Products') }}</b>
                        <div class="float-right">
                            <button type="button" class="btn btn-info btn-sm" id="add-product"><i class="fas fa-plus-circle fa-lg"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-5">
                                {!! Form::label('product_id[0]', __('Product')) !!}
                                {!! Form::select('product_id[0]', $products, null, ['id' => 'product_id', 'product-id'=> '0', 'class' => "product form-control select2 " . ($errors->has('product_id[0]') ? "is-invalid" : "")]) !!}
                                @if($errors->has('product_id[0]')) <div class="invalid-feedback">{{ $errors->first('product_id[0]') }}</div> @endif
                            </div>
                            <div class="col-md-2">
                                {!! Form::label('amount[0]', __('Amount')) !!}
                                {!! Form::number('amount[0]', null, ['product-id'=> '0', 'class' => "amount form-control " . ($errors->has('amount[0]') ? "is-invalid" : "")]) !!}
                                @if($errors->has('amount[0]')) <div class="invalid-feedback">{{ $errors->first('amount[0]') }}</div> @endif
                            </div>
                            <div class="col-md-2">
                                {!! Form::label('unit_price[0]', __('Unit Price')) !!}
                                {!! Form::text('unit_price[0]', null, ['class' => "form-control", 'readonly' => true]) !!}
                            </div>
                            <div class="col-md-2">
                                {!! Form::label('total_price[0]', __('Total Price')) !!}
                                {!! Form::text('total_price[0]', null, ['class' => "form-control total-price", 'readonly' => true]) !!}
                            </div>
                        </div>
                        <div id="products"></div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section('script')
@parent
<script src="{{ asset('assets/js/customers/product.js') }}"></script>
@endsection
