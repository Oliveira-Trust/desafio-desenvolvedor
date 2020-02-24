@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detalhe de Pedido</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nome: {{$purchase->customer->name}}</th>
                            </tr>
                            <tr>
                                <th>Pedido: {{$purchase->id}}</th>
                            </tr>
                            <tr>
                                <th>Data pedido: {{$purchase->created_at->format('d/m/Y H:i')}}</th>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Valor</th>
                                <th>Qtd</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchase->products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>R$ {{number_format($product->pivot->unitary_price,2,',','')}}</td>
                                    <td>{{$product->pivot->qtd}}</td>
                                    <td>R$ {{number_format($product->pivot->total_price,2,',','')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="text-right">
                                <td colspan="4">Valor total: R$ {{number_format($purchase->amount,2,',','')}}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
