@extends('layouts.app')

@section('content')
<h1>{{ __('Customers') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Customer information') }}</b>
        <div class="fa-pull-right">
            <div class="float-right">
                <a href="{{ route('customer.index') }}" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i></a>
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('Actions') }}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('customer.edit', ['id' => $customer->id])}}"><i class="fas fa-user-edit mr-2"></i>{{ __('Edit') }}</a>
                    <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                        data-name-delete="{{$customer->name}}" data-route-delete="{{route('customer.destroy', ['id' => $customer->id ])}}">
                        <i class="fas fa-trash-alt mr-2"></i>{{ __('Delete') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">{{ __('Identified') }}</th>
                        <td>{{ $customer->id }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Name') }}</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('E-mail') }}</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Contact') }}</th>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Address') }}</th>
                        <td>{{ $customer->address }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card">
            <div class="card-header bg-dark text-light">
                <b>{{ __('Order List') }}</b>
            </div>
            <div class="card-body">
                @include('orders.table')
            </div>
        </div>
    </div>
</div>
@endsection
