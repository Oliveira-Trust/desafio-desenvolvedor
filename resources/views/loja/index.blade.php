<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Loja') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="row">
            <div class="col-md-8">
                
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                    <tr>
                        <th scope="row">{{$produto->id}}</th>
                        <td><a href="{{route('editar_produto',['id' => $produto->id])}}">{{$produto->descricao}}</a></td>
                        <td>{{$produto->valor}}</td>
                        <td>
                            @if (1==1)
                                <button type="button" class="btn btn-success" onclick="inserirProdutoCarrinho({{$produto->id}})">Inserir</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination justify-content-center" style="margin-top: 12px;">
                    <!--paginacao-->
                    {{ $produtos->links() }}
                </div>
            </div>
            <div class="col-md-4">
                
                <b>Seu carrinho</b> - 
                @if ($carrinho->sum('quantidade') > 0)
                    <h3>total de items: {{$carrinho->sum('quantidade')}}</h3>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    Produto
                                </th>
                                <th>
                                    Quantidade
                                </th>
                                <th>
                                    Valor
                                </th>
                                <th>
                                    Total
                                </th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carrinho as $carrinhos)
                            <tr>
                                <td>
                                    {{$carrinhos->produto->descricao}}
                                </td>
                                <td>
                                    <select name="quantidade" onchange="atualizaQuantidade({{$carrinhos->id}},this.value)">
                                    @for ($i = 1; $i <= $carrinhos->produto->quantidade; $i++)
                                        <option value="{{$i}}" @if ($i == $carrinhos->quantidade) selected @endif> {{$i}} </option>
                                    @endfor
                                    </select>
                                </td>
                                <td>
                                    R$ {{number_format($carrinhos->produto->valor,2,',','.')}}
                                </td>
                                <td>
                                    R$ {{number_format(($carrinhos->produto->valor * $carrinhos->quantidade),2,',','.')}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="excluirProdutoCarrinho({{$carrinhos->id}},'{{$carrinhos->produto->descricao}}')">Excluir</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-light" onclick="cancelarPedido()">Cancelar</button><button type="button" class="btn btn-primary" onclick="checkoutPedido()">Checkout</button>
                @else
                    não há itens    
                @endif
            </div>
        </div>
    </div>
    
    <script>

        let _token = $('meta[name="csrf-token"]').attr('content');

        function atualizaQuantidade(id, quantidade)
        {
            let _url = "{{route('alterar_quantidade_produto_carrinho')}}";

            $.ajax({
                url: _url,
                type: "POST",
                data: {
                    _token: _token,
                    id: id,
                    quantidade: quantidade
                },
                success: function(data) {
                    document.location.reload(true);
                }
            });
        }

        function excluirProdutoCarrinho(id, produto)
        {
            var resposta = window.confirm("Deseja excluir o "+produto+"?");

            if (resposta) 
            {
                let _url = "{{route('excluir_produto_carrinho')}}";

                $.ajax({
                    url: _url,
                    type: "DELETE",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(data) {
                        document.location.reload(true);
                    }
                });
            }
        }

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
                    document.location.reload(true);
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
                    document.location.reload(true);
                }
            });
        }

        function cancelarPedido()
        {
            var resposta = window.confirm("Esta ação irá excluir todos os itens do carrinho. Deseja continuar?");

            if (resposta)
            {
                let _url = "{{route('cancelar_pedido')}}";

                $.ajax({
                    url: _url,
                    type: "DELETE",
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        document.location.reload(true);
                    }
                });
            }
        }

    </script>
</x-app-layout>
