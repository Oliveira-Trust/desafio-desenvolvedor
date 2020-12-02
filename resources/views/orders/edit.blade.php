@extends('layouts.app')

@section('style')
@parent
@endsection

@section('content')
<h1>{{ __('Orders') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Edit Order') }}</b>
        <div class="float-right">
            <a href="{{ route('order.index') }}" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i></a>
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Actions') }}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('order.show', ['id' => $order->id])}}"><i class="fas fa-eye mr-2"></i>{{ __('See') }}</a>
                <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                    data-name-delete="{{$order->code}} / {{$order->customer->name}}" data-route-delete="{{route('order.destroy', ['id' => $order->id ])}}">
                    <i class="fas fa-trash-alt mr-2"></i>{{ __('Delete') }}
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        {!! Form::model($order, ['method' => "PATCH", "route" => ['order.update', $order->id]]) !!}
        <div class="form-row mb-3">
            <div class="col-md-5 form-group">
                {!! Form::label('customer_id', __('Customer')) !!}
                {!! Form::select('customer_id', $customers, null, ['class' => "form-control select2 " . ($errors->has('customer_id') ? "is-invalid" : "")]) !!}
                @if($errors->has('customer_id')) <div class="invalid-feedback">{{ $errors->first('customer_id') }}</div> @endif
            </div>
            <div class="col-md-3">
                {!! Form::label('code', __('Code')) !!}
                {!! Form::text('code', null, ['class' => "form-control " . ($errors->has('code') ? "is-invalid" : "")]) !!}
                @if($errors->has('code')) <div class="invalid-feedback">{{ $errors->first('code') }}</div> @endif
            </div>
            <div class="col-md-2">
                {!! Form::label('status', __('Status')) !!}
                {!! Form::select('status', [
                'Opened' => __('Opened'),
                'Paid out' => __('Paid out'),
                'Canceled' => __('Canceled')
                ], null, ['class' => "form-control " . ($errors->has('status') ? "is-invalid" : "")]) !!}
                @if($errors->has('status')) <div class="invalid-feedback">{{ $errors->first('status') }}</div> @endif
            </div>
            <div class="col-md-2">
                {!! Form::label('order_total_price', __('Total order')) !!}
                {!! Form::text('order_total_price', null, ['class' => "form-control", 'readonly' => true]) !!}
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <b>{{ __('List Products') }}</b>
                        <div class="float-right">
                            <button type="button" class="btn btn-info btn-sm" id="add-product"><i class="fas fa-plus-circle fa-lg"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        @isset($order->products)
                            @foreach ($order->products as $key => $product)
                                <div class="form-group row event-group{{$key}}">
                                    <div class="col-md-5">
                                        {!! Form::label("product_id[$key]", __("Product")) !!}
                                        {!! Form::select("product_id[$key]", $products, $product->id, ["id" => "product_id", "product-id"=> "$key", "class" => "product form-control select2 " . ($errors->has("product_id[$key]") ? "is-invalid" : "")]) !!}
                                        @if($errors->has("product_id[$key]")) <div class="invalid-feedback">{{ $errors->first("product_id[$key]") }}</div> @endif
                                    </div>
                                    <div class="col-md-2">
                                        {!! Form::label("amount[$key]", __("Amount")) !!}
                                        {!! Form::number("amount[$key]", $product->pivot->amount, ["product-id"=> "$key", "class" => "amount form-control " . ($errors->has("amount[$key]") ? "is-invalid" : "")]) !!}
                                        @if($errors->has("amount[$key]")) <div class="invalid-feedback">{{ $errors->first("amount[$key]") }}</div> @endif
                                    </div>
                                    <div class="col-md-2">
                                        {!! Form::label("unit_price[$key]", __("Unit Price")) !!}
                                        {!! Form::text("unit_price[$key]", $product->price, ["class" => "form-control", "readonly" => true]) !!}
                                    </div>
                                    <div class="col-md-2">
                                        {!! Form::label("total_price[$key]", __("Total Price")) !!}
                                        {!! Form::text("total_price[$key]", $product->pivot->total_price, ["class" => "form-control total-price", "readonly" => true]) !!}
                                    </div>
                                    <div class="col-md-1 d-flex justify-content-center align-items-center">
                                        <a href="#" event-group="{{$key}}" delete-id="{{$product->pivot->id}}" class="remove">
                                            <i class="fas fa-minus-circle fa-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
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
