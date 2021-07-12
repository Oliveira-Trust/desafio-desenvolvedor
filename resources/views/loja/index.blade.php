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
                            @else 
                                No carrinho!
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
                                    <button type="button" class="btn btn-danger" onclick="excluirProdutoCarrinho({{$carrinhos->id}},'{{$carrinhos->produto->descricao}}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                        </svg>  
                                    </button>
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
