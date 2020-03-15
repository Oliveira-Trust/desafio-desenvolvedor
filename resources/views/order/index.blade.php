@extends('layouts.template')

@section('title', 'Pedidos')

@section('content')

    <div class="container p-5">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('danger'))
            <div class="alert alert-danger">{{ session('danger') }}</div>
        @endif

        <h2>Lista de Pedidos</h2>

        <form class="row mt-2" method="get">

            <div class="col-md-2 col-form-label font-weight-bold mb-2">Status:</div>
            <div class="col-md-4 mb-2">
                <select name="status" id="status" class="form-control">
                    <option value="0">Todos</option>
                    <option {{ $filters['status'] == 'cancel' ? 'selected' : ''  }} value="cancel">Cancelado</option>
                    <option {{ $filters['status'] == 1 ? 'selected' : ''  }} value="1">Em Aberto</option>
                    <option {{ $filters['status'] == 2 ? 'selected' : ''  }} value="2">Pago</option>
                </select>
            </div>

            <div class="col-md-6"></div>

            <div class="col-md-2 col-form-label font-weight-bold">Valor Inicial:</div>
            <div class="col-md-2"><input type="text" class="form-control" name="price_initial" id="price_initial" value="{{ $filters['price_initial'] ? $filters['price_initial'] : '' }}"></div>

            <div class="col-md-2 col-form-label font-weight-bold">Valor Final:</div>
            <div class="col-md-2"><input type="text" class="form-control" name="price_end" id="price_end" value="{{ $filters['price_end'] ? $filters['price_end'] : '' }}"></div>

            <div class="col-md-2 col-form-label font-weight-bold">Ordernar por:</div>
            <div class="col-md-2">
                <select name="order" id="order" class="form-control">
                    <option {{ $filters['order'] == 'created_at' ? 'selected' : '' }} value="created_at">Data</option>
                    <option {{ $filters['order'] == 'id' ? 'selected' : '' }} value="id">ID</option>
                    <option {{ $filters['order'] == 'status' ? 'selected' : '' }} value="status">status</option>
                    <option {{ $filters['order'] == 'price' ? 'selected' : '' }} value="price">Preço</option>
                </select>
            </div>

            <div class="col-md-8 mt-4"></div>
            <div class="col-md-4 mt-4">
                <button class="btn btn-md btn-info btn-block text-light">Filtrar</button>
            </div>
        </form>

        @if($orders->count() > 0)
            <table class="table table-stripped table-hover mt-3">
                <thead class="bg-primary text-light">
                <tr>
                    <th class="text-center" width="80">ID</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Data do Pedido</th>
                    <th width="160" class="text-center">AÇÕES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="text-center">{{$order->id}}</td>
                        <td class="text-center">R$ {{number_format($order->total, 2, ',', '.')}}</td>
                        <td class="text-center">
                            @switch($order->status)
                                @case('0')
                                    <span class="text-danger">Cancelado</span>
                                @break

                                @case('1')
                                    <span class="text-primary">Em Aberto</span>
                                @break

                                @case('2')
                                    <span class="text-success">Pago</span>
                                @break
                            @endswitch
                        </td>
                        <td class="text-center">{{date('d/m/Y', strtotime($order->created_at))}}</td>
                        <td class="text-center">
                            <span class="btn-group">
                                <a href="javascript:;" class="btn btn-sm btn-primary showInfo" data-url="{{route('order.show', $order->id)}}">Ver</a>

                                @if($order->status == 1)
                                    <a href="{{route('order.cancel', $order->id)}}" class="btn btn-sm btn-danger ml-1">Cancelar</a>
                                @endif

                                @if (Auth::user()->access == 'ADMIN' && $order->status == 1)
                                    <a href="{{route('order.aproved', $order->id)}}" class="btn btn-sm btn-success ml-1">Aprovar</a>
                                @endif
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning mt-4">
                Nenhum pedido realizado!!!
            </div>
        @endif

    </div>

@endsection

@section('scripts')
    <script>
       $(document).on('click', '.showInfo', function () {
           let url = $(this).data('url');
           $.ajax({
               url: url,
               type: 'GET',
               dataType: 'json',
               success: function (json) {

                   $('.modal-header, .close').addClass('bg-primary').addClass('text-light');
                   $('#title-modal').html('Visualização do Pedido');

                   let statusOrder = '';
                   switch (json.status) {
                       case 0:
                           statusOrder = 'Cancelado';
                           break;

                       case 1:
                           statusOrder = 'Em Aberto';
                           break;

                       case 2:
                           statusOrder = 'Pago';
                           break;
                   }

                   let headerBuy =  '<div class="form-group">Total <strong>R$ ' + json.total + ' </strong> </div>' +
                                    '<div class="form-group">Data do Pedido <strong>R$ ' + json.date + ' </strong> </div>' +
                                    '<div class="form-group">Status <strong> ' + statusOrder + ' </strong> </div>';

                   let bodyBuy  =   '<table class="table table-hover table-striped mt-5">' +
                                    '<thead> <tr> <th>ID</th> <th>Título</th> <th>Preço</th> <th>Qtd</th> <th>SubTotal</th> </tr> </thead>' +
                                    '<tbody>';
                   console.log(json.items);
                   for(i=0; i<json.items.length; i++){
                       bodyBuy +=   '<tr>' +
                           '<td> '+ json.items[i].id +' </td>' +
                           '<td> '+ json.items[i].title +' </td>' +
                           '<td>R$ '+ json.items[i].price +' </td>' +
                           '<td> '+ json.items[i].qtd +' </td>' +
                           '<td>R$ '+ (json.items[i].qtd * json.items[i].price) +' </td>' +
                           '</tr>';
                   }

                    bodyBuy += '</tbody></table>';

                   $('.modal-body').html(headerBuy + bodyBuy);

                   $('#cancel').html('Fechar');
                   $('#save').hide();

                   $('.modal').modal('show');

               }
           });
       });
    </script>
@endsection
