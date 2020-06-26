@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-12">
            <div class="card border-dark">
                <div class="card-header bg-dark text-light">
                    {{ __('Edit') }} {{ __('product.name') }}
                </div>
                <div class="card-body">
                    {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch']) !!}
                    @include('products.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection