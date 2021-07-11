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
                <td><button type="button" class="btn btn-danger" onclick="inserirProdutoCarrinho({{$produto->id}})">Inserir</button></td>
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
    </div>
    
    <script>

        function checkoutPedido()
        {
            let _url = "{{route('checkout_pedido')}}";
            let _token = $('meta[name="csrf-token"]').attr('content');

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
            let _token = $('meta[name="csrf-token"]').attr('content');

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

    </script>

</x-app-layout>
