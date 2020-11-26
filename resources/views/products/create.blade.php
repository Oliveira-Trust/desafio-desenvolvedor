@extends('layouts.app')

@section('content')
<h1>{{ __('Products') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Add Product') }}</b>
    </div>
    <div class="card-body">
        {!! Form::open(['method' => "POST", "route" => "product.store"]) !!}
            <div class="form-row mb-3">
                <div class="col-md-4">
                    {!! Form::label('code', __('Code')) !!}
                    {!! Form::text('code', '', ['class' => "form-control " . ($errors->has('code') ? "is-invalid" : "")]) !!}
                    @if($errors->has('code')) <div class="invalid-feedback">{{ $errors->first('code') }}</div> @endif
                </div>
                <div class="col-md-4">
                    {!! Form::label('name', __('Name')) !!}
                    {!! Form::text('name', '', ['class' => "form-control " . ($errors->has('name') ? "is-invalid" : "")]) !!}
                    @if($errors->has('name')) <div class="invalid-feedback">{{ $errors->first('name') }}</div> @endif
                </div>
                <div class="col-md-2">
                    {!! Form::label('price', __('Price')) !!}
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">R$</div>
                        </div>
                        {!! Form::text('price', '', ['class' => "form-control " . ($errors->has('price') ? "is-invalid" : "")]) !!}
                        @if($errors->has('price')) <div class="invalid-feedback">{{ $errors->first('price') }}</div> @endif
                    </div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('stock', __('Stock')) !!}
                    {!! Form::number('stock', '', ['class' => "form-control " . ($errors->has('stock') ? "is-invalid" : "")]) !!}
                    @if($errors->has('stock')) <div class="invalid-feedback">{{ $errors->first('stock') }}</div> @endif
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-12">
                    {!! Form::label('description', __('Description')) !!}
                    {!! Form::textarea('description', '', ['class' => "form-control " . ($errors->has('description') ? "is-invalid" : "")]) !!}
                    @if($errors->has('description')) <div class="invalid-feedback">{{ $errors->first('description') }}</div> @endif
                </div>
            </div>
            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
