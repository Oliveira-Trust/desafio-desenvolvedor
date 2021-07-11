<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meus pedidos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Data do pedido</th>
                <th scope="col">Total de itens</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                <tr>
                  <th scope="row">{{$pedido->id}}</th>
                  <td>{{$pedido->created_at->format('d/m/Y H:i')}}</td>
                  <td>{{$pedido->produtos()->count()}}</td>
                  <td>R$ {{number_format($pedido->produtos()->sum('pedido_produto.valor'),2,',','.')}}</td>
                  <td>{{$pedido->status}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <div class="pagination justify-content-center" style="margin-top: 12px;">
            <!--paginacao-->
           
          </div>
    </div>
    
    <script>

    </script>

</x-app-layout>
