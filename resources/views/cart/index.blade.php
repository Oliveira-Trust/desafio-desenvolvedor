@extends('layouts.template')

@section('title', 'Carrinho de Compras')

@section('content')

    <div class="container p-5">

        <h2>Carrinho de Compras</h2>

        @if(isset($items) && count($items) > 0)

        <table class="table table-hover table stripped mt-3">
            <thead class="bg-primary text-light">
                <tr>
                    <td>Produto</td>
                    <td>Preço</td>
                    <td>Quantidade</td>
                    <td>Subtotal</td>
                    <td width="50">Ações</td>
                </tr>
            </thead>
            <tbody>
                @php $total = 0;  @endphp

                @foreach($items as $item)
                    <tr>
                        <td>{{$item['title']}}</td>
                        <td>R$ {{number_format($item['price'], 2, ',', '.')}}</td>
                        <td>{{$item['qtd']}}</td>
                        <td>R$ {{number_format(($item['qtd'] * $item['price']), 2, ',', '.')}}</td>
                        <td>
                            <a href="{{route('cart.remove', $item['id'])}}" class="btn btn-sm btn-danger">Excluir</a>
                        </td>
                    </tr>
                    @php $total += ($item['qtd'] * $item['price']);  @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right font-weight-bold">TOTAL DO PEDIDO</td>
                    <td colspan="2" class="font-weight-bold text-center">R$ {{number_format($total, 2, ',', '.')}}</td>
                </tr>
            </tfoot>
        </table>

        <a href="{{route('cart.cancel')}}" class="btn btn-md btn-danger float-left">Cancelar Compra</a>
        <a href="{{route('order.finally')}}" class="btn btn-md btn-success float-right">Finalizar Compra</a>

        @else
            <div class="alert alert-warning">Carrinho Vazio</div>
        @endif

    </div>

@endsection
