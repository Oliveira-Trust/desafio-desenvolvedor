@extends('layouts.app')

@section('content')
<h1>{{ __('Products') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Product information') }}</b>
        <div class="fa-pull-right">
            <div class="float-right">
                <a href="{{ route('product.index') }}" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i></a>
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('Actions') }}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('product.edit', ['id' => $product->id])}}"><i class="fas fa-user-edit mr-2"></i>{{ __('Edit') }}</a>
                    <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                        data-name-delete="{{$product->name}}" data-route-delete="{{route('product.destroy', ['id' => $product->id ])}}">
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
                        <td>{{ $product->code }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Name') }}</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Price') }}</th>
                        <td>{{ $product->price }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Stock') }}</th>
                        <td>{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Description') }}</th>
                        <td>{{ $product->description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
