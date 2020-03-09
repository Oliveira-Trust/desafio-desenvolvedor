<div class="card">
    <div class="card-header">{{ __('Produtos') }} -- R$ {{number_format($order->calculateValue(),2)}}</div>
    <div class="card-body">
        <div class="table-responsive">
                <table class="table">

                        <thead>
                                <tr>
                                  <th scope="col">Nome</th>
                                  <th scope="col">Valor Unitário</th>
                                  <th scope="col">Quantidade</th>
                                  <th scope="col">Total</th>
                                  @if ($order->status == 'Pedido em digitação' && ($action ?? '') != 'show')
                                  <th scope="col">Actions</th>
                                  @endif
                                </tr>
                              </thead>

                              <tbody>
                                    @foreach ($order->products as $item)
                                    <tr>
                                      <th scope="row">{{$item->product->name}}</th>
                                      <td>{{$item->product->price}}</td>
                                      <td>{{$item->quantity}}</td>
                                      <td>R${{number_format($item->quantity * $item->product->price, 2)}}</td>
                                      @if ($order->status == 'Pedido em digitação' && ($action ?? '') != 'show')
                                      <td>
                                            <form method="POST" action="{{ route('order.removeProduct', ['order' => $order->id]) }}">
                                                <input type="text" hidden name="product" value="{{$item->id}}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                <tbody>
                </table>
              </div>




        @if ($order->status == 'Pedido em digitação' && ($action ?? '') != 'show')
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <form method="POST" action="{{ route('order.commit', ['order' => $order->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        {{ __('Finalizar Pedido') }}
                    </button>
                </form>
            </div>
        </div>
        @endif



    </div>
</div>
