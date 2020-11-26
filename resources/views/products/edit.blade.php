@extends('layouts.app')

@section('content')
<h1>{{ __('Products') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Add Product') }}</b>
        <div class="float-right">
            <a href="{{ route('product.index') }}" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i></a>
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Actions') }}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('product.show', ['id' => $product->id])}}"><i class="fas fa-eye mr-2"></i>{{ __('See') }}</a>
                <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                    data-name-delete="{{$product->name}}" data-route-delete="{{route('product.destroy', ['id' => $product->id ])}}">
                    <i class="fas fa-trash-alt mr-2"></i>{{ __('Delete') }}
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        {!! Form::model($product, ['method' => "PATCH", "route" => ['product.update', $product->id]]) !!}
            <div class="form-row mb-3">
                <div class="col-md-4">
                    {!! Form::label('code', __('Code')) !!}
                    {!! Form::text('code', null, ['class' => "form-control " . ($errors->has('code') ? "is-invalid" : "")]) !!}
                    @if($errors->has('code')) <div class="invalid-feedback">{{ $errors->first('code') }}</div> @endif
                </div>
                <div class="col-md-4">
                    {!! Form::label('name', __('Name')) !!}
                    {!! Form::text('name', null, ['class' => "form-control " . ($errors->has('name') ? "is-invalid" : "")]) !!}
                    @if($errors->has('name')) <div class="invalid-feedback">{{ $errors->first('name') }}</div> @endif
                </div>
                <div class="col-md-2">
                    {!! Form::label('price', __('Price')) !!}
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">R$</div>
                        </div>
                        {!! Form::text('price', null, ['class' => "form-control " . ($errors->has('price') ? "is-invalid" : "")]) !!}
                        @if($errors->has('price')) <div class="invalid-feedback">{{ $errors->first('price') }}</div> @endif
                    </div>
                </div>
                <div class="col-md-2">
                    {!! Form::label('stock', __('Stock')) !!}
                    {!! Form::number('stock', null, ['class' => "form-control " . ($errors->has('stock') ? "is-invalid" : "")]) !!}
                    @if($errors->has('stock')) <div class="invalid-feedback">{{ $errors->first('stock') }}</div> @endif
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-12">
                    {!! Form::label('description', __('Description')) !!}
                    {!! Form::textarea('description', null, ['class' => "form-control " . ($errors->has('description') ? "is-invalid" : "")]) !!}
                    @if($errors->has('description')) <div class="invalid-feedback">{{ $errors->first('description') }}</div> @endif
                </div>
            </div>
            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
