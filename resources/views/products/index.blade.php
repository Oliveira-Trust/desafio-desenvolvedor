@extends('layouts.app')

@section('style')
@parent
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection

@section('content')
<h1>{{ __('Products') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Product List') }}</b>
        <div class="fa-pull-right">
            <a href="{{ route('product.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="table">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Price') }}</th>
                    <th scope="col">{{ __('Stock') }}</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr @if($product->trashed()) class="table-danger" @endif>
                            <th scope="row">{{ $product->code }}</th>
                            <td>{{ $product->name }}</td>
                            <td>R$ {{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                @if(!$product->trashed())
                                    <div class="float-right">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ __('Actions') }}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('product.show', ['id' => $product->id])}}"><i class="fas fa-eye mr-2"></i>{{ __('See') }}</a>
                                            <a class="dropdown-item" href="{{ route('product.edit', ['id' => $product->id])}}"><i class="fas fa-user-edit mr-2"></i>{{ __('Edit') }}</a>
                                            <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                                                data-name-delete="{{$product->name}}" data-route-delete="{{route('product.destroy', ['id' => $product->id ])}}">
                                                <i class="fas fa-trash-alt mr-2"></i>{{ __('Delete') }}
                                            </a>
                                        </div>
                                    </div>
                                @else
                                <div class="float-right">
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __('Actions') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item restore" href="#" data-toggle="modal" data-target="#restore-modal"
                                            data-name="{{$product->name}}" data-route="{{ route('product.restore', ['id' => $product->id])}}">
                                            <i class="fas fa-trash-restore-alt mr-2"></i>{{ __('Restore') }}
                                        </a>
                                        <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                                            data-name-delete="{{$product->name}}" data-route-delete="{{route('product.delete', ['id' => $product->id ])}}">
                                            <i class="fas fa-trash-alt mr-2"></i>{{ __('Force delete') }}
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if ($products->hasPages())
    <div class="card-footer">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection

@section('script')
@parent
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>$('#table').DataTable();</script>
@endsection
