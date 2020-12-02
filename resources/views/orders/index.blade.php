@extends('layouts.app')

@section('content')
<h1>{{ __('Orders') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Order List') }}</b>
        <div class="fa-pull-right">
            <a href="{{ route('order.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i></a>
            <a href="#" class="btn btn-sm btn-warning d-none" id="mass-delete"><i class="fas fa-minus"></i></a>
        </div>
    </div>
    <div class="card-body">
        @include('orders.table')
    </div>
</div>
@endsection

