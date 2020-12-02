@extends('layouts.app')

@section('style')
@parent
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection

@section('content')
<h1>{{ __('Customers') }}</h1>
<div class="card">
    <div class="card-header bg-dark text-light">
        <b>{{ __('Customer List') }}</b>
        <div class="fa-pull-right">
            <a href="{{ route('customer.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i></a>
            <a href="#" class="btn btn-sm btn-warning d-none" id="mass-delete"><i class="fas fa-minus"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="table">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('E-mail') }}</th>
                    <th scope="col">{{ __('Contact') }}</th>
                    <th scope="col"></th>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr @if($customer->trashed()) class="table-danger" @endif delete-id="{{route('customer.delete',[$customer->id])}}">
                            <th scope="row">{{ $customer->id }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>
                                @if(!$customer->trashed())
                                    <div class="float-right">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ __('Actions') }}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('customer.show', ['id' => $customer->id])}}"><i class="fas fa-eye mr-2"></i>{{ __('See') }}</a>
                                            <a class="dropdown-item" href="{{ route('customer.edit', ['id' => $customer->id])}}"><i class="fas fa-user-edit mr-2"></i>{{ __('Edit') }}</a>
                                            <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                                                data-name-delete="{{$customer->name}}" data-route-delete="{{route('customer.destroy', ['id' => $customer->id ])}}">
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
                                            data-name="{{$customer->name}}" data-route="{{ route('customer.restore', ['id' => $customer->id])}}">
                                            <i class="fas fa-trash-restore-alt mr-2"></i>{{ __('Restore') }}
                                        </a>
                                        <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                                            data-name-delete="{{$customer->name}}" data-route-delete="{{route('customer.delete', ['id' => $customer->id ])}}">
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
</div>
@endsection

@section('script')
@parent
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>$('#table').DataTable();</script>
@endsection
