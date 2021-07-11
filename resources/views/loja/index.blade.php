<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Loja') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <button type="button" class="btn btn-primary" onclick="window.location='{{route('novo_produto')}}'">Inserir novo produto</button>
        <br>

        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ação</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
              <tr>
                <th scope="row">{{$produto->id}}</th>
                <td><a href="{{route('editar_produto',['id' => $produto->id])}}">{{$produto->descricao}}</a></td>
                <td>{{$produto->valor}}</td>
                <td>{{$produto->quantidade}}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="inserirProdutoCarrinho({{$produto->id}})">Inserir</button>
                    
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="pagination justify-content-center" style="margin-top: 12px;">
            <!--paginacao-->
            {{ $produtos->links() }}
          </div>

          <br>

          <button type="button" class="btn btn-danger" onclick="checkoutPedido()">Checkout</button>
          <button type="button" class="btn btn-danger" onclick="cancelarPedido()">Cancelar</button>
    </div>
    
    <script>

        let _token = $('meta[name="csrf-token"]').attr('content');

        function checkoutPedido()
        {
            let _url = "{{route('checkout_pedido')}}";

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    _token: _token
                },
                success: function(data) {
                    console.log(data)
                }
            });
        }

        function inserirProdutoCarrinho(id)
        {
            let _url = "{{route('inserir_produto_carrinho')}}";

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    _token: _token,
                    produto_id: id
                },
                success: function(data) {
                    console.log(data);
                }
            });
        }

        function cancelarPedido()
        {
            let _url = "{{route('cancelar_pedido')}}";

            $.ajax({
                url: _url,
                type: "DELETE",
                data: {
                    _token: _token
                }
            });
        }

    </script>

</x-app-layout>
