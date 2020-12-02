@extends('layouts.app')

@section('content')
<h1>{{ __('Orders') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Order information') }}</b>
        <div class="fa-pull-right">
            <div class="float-right">
                <a href="{{ route('order.index') }}" class="btn btn-sm btn-info"><i class="fas fa-arrow-left"></i></a>
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('Actions') }}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('order.edit', ['id' => $order->id])}}"><i class="fas fa-user-edit mr-2"></i>{{ __('Edit') }}</a>
                    <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                        data-name-delete="{{$order->code}} / {{$order->customer->name}}" data-route-delete="{{route('order.destroy', ['id' => $order->id ])}}">
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
                        <td>{{ $order->id }}</td>
                        <th>{{ __('Status') }}</th>
                        <td>{{ __($order->status) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Customer') }}</th>
                        <td colspan="3">{{ $order->customer->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Contact') }}</th>
                        <td colspan="3">{{ $order->customer->phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Address') }}</th>
                        <td colspan="3">{{ $order->customer->address }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Total Price') }}</th>
                        <td colspan="3">R$ {{ $order->order_total_price }}</td>
                    </tr>
                    <tr>
                        <th scope="row">{{ __('Seller') }}</th>
                        <td colspan="3">{{ $order->seller->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row my-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <b>{{ __('List Products') }}</b>
                        <div class="float-right">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __("Identified") }}</th>
                                        <th>{{ __("Product") }}</th>
                                        <th>{{ __("Amount") }}</th>
                                        <th>{{ __("Unit Price") }}</th>
                                        <th>{{ __("Total Price") }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td>{{ $product->code }}</td>
                                            <td><a href="{{route('product.show', [$product->id]) }}" >{{ $product->name }}</a></td>
                                            <td>{{ $product->pivot->amount }}</td>
                                            <td>R$ {{ $product->price }}</td>
                                            <td>R$ {{ $product->pivot->total_price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
