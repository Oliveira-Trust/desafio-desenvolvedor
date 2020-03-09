<div class="card">
    <div class="card-header">{{ __('Dados do Pedido') }}
        <a href={{ route('order.index') }}>
            <button class="btn btn-danger float-right">
                <i class="fas fa-arrow-left"></i>
                {{ __('Back') }}
            </button>
        </a>
    </div>
    <div class="card-body">
        <div class="form-group row">

            <div class="col-md-4">
                Cliente:
            </div>
            <div class="col-md-8">
                <a href="{{ route('client.show', ['client' => $order->client->id]) }}">{{$order->client->name}}</a>
            </div>

        </div>

        <div class="form-group row">

            <div class="col-md-4">
                Usuário Responsável:
            </div>
            <div class="col-md-8">
                <a href="#">{{$order->user->name}}</a>
            </div>

        </div>

        <div class="form-group row">

            <div class="col-md-4">
                Valor Total:
            </div>
            <div class="col-md-8">
                R${{number_format($order->value,2)}}
            </div>

        </div>

        <div class="form-group row">

            <div class="col-md-4">
                Status do Pedido:
            </div>
            <div class="col-md-8">
                {{$order->status}}
            </div>

        </div>
        @if (($action ?? '') != 'show' && auth()->user()->admin)
        <div class=" row justify-content-around">
            <div class="col-md-3 ">
                @if ($order->status == \App\Order::AWAITING_PAYMENT)
                <form method="POST" action="{{ route('order.confirmPayment', ['order' => $order->id]) }}">
                    {{-- <input type="text" hidden name="product" value="{{$item->id}}"> --}}
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-money-bill-alt"></i> Confirmar Pgto
                    </button>
                </form>
                @endif
            </div>
            <div class="col-md-3 ">
                @if ($order->status == \App\Order::AWAITING_PAYMENT | $order->status == \App\Order::TYPING_ORDER  )
                <form method="POST" action="{{ route('order.destroy', ['order' => $order->id]) }}">
                    {{-- <input type="text" hidden name="product" value="{{$item->id}}"> --}}
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-hand-holding-usd"></i> Cancelar Pedido
                    </button>
                </form>

                @endif
            </div>

        </div>
        @endif

    </div>
</div>
