@section('style')
@parent
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection

<div class="table-responsive">
    <table class="table table-striped" id="table">
        <thead>
            <th scope="col">#</th>
            <th scope="col">{{ __('Customer') }}</th>
            <th scope="col">{{ __('Total Price') }}</th>
            <th scope="col">{{ __('Seller') }}</th>
            <th scope="col"></th>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr @if($order->trashed()) class="table-danger" @endif delete-id="{{route('order.delete',[$order->id])}}">
                    <th scope="row">{{ $order->code }}</th>
                    <td><a href="{{route('customer.show', [$order->customer->id]) }}" >{{$order->customer->name }} </a></td>
                    <td>R$ {{ $order->order_total_price }}</td>
                    <td>{{ $order->seller->name }}</td>
                    <td>
                        @if(!$order->trashed())
                            <div class="float-right">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Actions') }}
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('order.show', ['id' => $order->id])}}"><i class="fas fa-eye mr-2"></i>{{ __('See') }}</a>
                                    <a class="dropdown-item" href="{{ route('order.edit', ['id' => $order->id])}}"><i class="fas fa-user-edit mr-2"></i>{{ __('Edit') }}</a>
                                    <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                                        data-name-delete="{{$order->code}} / {{$order->customer->name}}" data-route-delete="{{route('order.destroy', ['id' => $order->id ])}}">
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
                                    data-name="{{$order->code}} / {{$order->customer->name}}" data-route="{{ route('order.restore', ['id' => $order->id])}}">
                                    <i class="fas fa-trash-restore-alt mr-2"></i>{{ __('Restore') }}
                                </a>
                                <a class="dropdown-item delete" href="#" data-toggle="modal" data-target="#delete-modal"
                                    data-name-delete="{{$order->code}} / {{$order->customer->name}}" data-route-delete="{{route('order.delete', ['id' => $order->id ])}}">
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

@section('script')
@parent
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
@endsection
