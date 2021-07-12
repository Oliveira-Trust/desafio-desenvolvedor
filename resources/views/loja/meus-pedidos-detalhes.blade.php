<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meus pedidos') }} - Compra realizada em:  {{$pedidos->created_at->format('d/m/Y H:i')}} / Status: {{$pedidos->status}}
        </h2>
    </x-slot>
    <div class="py-12">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Produto</th>
                <th scope="col">Total de itens</th>
                <th scope="col">Valor</th>
                <th scope="col">Valor Total</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $totalPago = 0;
                @endphp 
                @foreach ($pedidos->produtos()->get() as $pedidosProdutos)
                <tr>
                    <td>
                        {{$pedidosProdutos->descricao}}
                    </td>
                    <td>
                        {{$pedidosProdutos->quantidade}}
                    </td>
                    <td>
                        R$ {{number_format($pedidosProdutos->valor,2,',','.')}}
                    </td>
                    <td>
                        R$ {{number_format(($pedidosProdutos->valor * $pedidosProdutos->quantidade),2,',','.')}}
                    </td>
                </tr>
                    @php
                        $totalPago += $pedidosProdutos->valor * $pedidosProdutos->quantidade;
                    @endphp 
                @endforeach
                @if ($pedidos->status == 'Pago')
                <tr>
                    <td colspan="3" style='text-align:right'>
                        <b>Total pago</b>
                    </td>
                    <td>
                        R$ R$ {{number_format($totalPago,2,',','.')}}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        <br>
        <button type="submit" id="btnVoltar" class="btn btn-secondary" onclick="window.location='{{route('meus_pedidos')}}'">Voltar</button>
    </div>

</x-app-layout>
