@extends('layouts.app')

@section('content')
<h1>{{ __('Customers') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Edit Customer') }}</b>
        <div class="float-right">
            <a href="{{ route('customer.index') }}" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i></a>
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Actions') }}
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('customer.show', ['id' => $customer->id])}}"><i class="fas fa-eye mr-2"></i>{{ __('See') }}</a>
                <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                    data-name-delete="{{$customer->name}}" data-route-delete="{{route('customer.destroy', ['id' => $customer->id ])}}">
                    <i class="fas fa-trash-alt mr-2"></i>{{ __('Delete') }}
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        {!! Form::model($customer, ['method' => "PATCH", "route" => ['customer.update', $customer->id]]) !!}
            <div class="form-row mb-3">
                <div class="col-md-6">
                    {!! Form::label('name', __('Name')) !!}
                    {!! Form::text('name', null, ['class' => "form-control " . ($errors->has('name') ? "is-invalid" : "")]) !!}
                    @if($errors->has('name')) <div class="invalid-feedback">{{ $errors->first('name') }}</div> @endif
                </div>
                <div class="col-md-6">
                    {!! Form::label('email', __('E-mail')) !!}
                    {!! Form::email('email', null, ['class' => "form-control " . ($errors->has('email') ? "is-invalid" : "")]) !!}
                    @if($errors->has('email')) <div class="invalid-feedback">{{ $errors->first('email') }}</div> @endif
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col-md-4">
                    {!! Form::label('phone', __('Contact')) !!}
                    {!! Form::text('phone', null, ['class' => "form-control " . ($errors->has('phone') ? "is-invalid" : "")]) !!}
                    @if($errors->has('phone')) <div class="invalid-feedback">{{ $errors->first('phone') }}</div> @endif
                </div>
                <div class="col-md-8">
                    {!! Form::label('address', __('Address')) !!}
                    {!! Form::text('address', null, ['class' => "form-control " . ($errors->has('address') ? "is-invalid" : "")]) !!}
                    @if($errors->has('address')) <div class="invalid-feedback">{{ $errors->first('address') }}</div> @endif
                </div>
            </div>
            <button class="btn btn-primary" type="submit">{{ __('Record') }}</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
