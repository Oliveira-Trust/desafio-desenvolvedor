@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12">
            <div class="card border-dark">
                <div class="card-header bg-dark text-light">
                    {{ __('Add') }} {{ __('order.name') }}
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'orders.store']) !!}

                    @include('orders.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection