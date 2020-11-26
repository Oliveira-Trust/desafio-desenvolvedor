@extends('layouts.app')

@section('content')
<h1>{{ __('Customers') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Add Customer') }}</b>
    </div>
    <div class="card-body">
        {!! Form::open(['method' => "POST", "route" => "customer.store"]) !!}
            <div class="form-row mb-3">
                <div class="col-md-6">
                    {!! Form::label('name', 'Nome') !!}
                    {!! Form::text('name', '', ['class' => "form-control " . ($errors->has('name') ? "is-invalid" : "")]) !!}
                    @if($errors->has('name')) <div class="invalid-feedback">{{ $errors->first('name') }}</div> @endif
                </div>
                <div class="col-md-6">
                    {!! Form::label('email', 'E-mail') !!}
                    {!! Form::email('email', '', ['class' => "form-control " . ($errors->has('email') ? "is-invalid" : "")]) !!}
                    @if($errors->has('email')) <div class="invalid-feedback">{{ $errors->first('email') }}</div> @endif
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-4">
                    {!! Form::label('phone', 'Contato') !!}
                    {!! Form::text('phone', '', ['class' => "form-control " . ($errors->has('phone') ? "is-invalid" : "")]) !!}
                    @if($errors->has('phone')) <div class="invalid-feedback">{{ $errors->first('phone') }}</div> @endif
                </div>
                <div class="col-md-8">
                    {!! Form::label('address', 'Endereço') !!}
                    {!! Form::text('address', '', ['class' => "form-control " . ($errors->has('address') ? "is-invalid" : "")]) !!}
                    @if($errors->has('address')) <div class="invalid-feedback">{{ $errors->first('address') }}</div> @endif
                </div>
            </div>
            <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
