@extends('layouts.app')

@section('title', 'Atualizar pedido de Compra')

@section('content')
    <div class="row mt-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('pedidos.index') }}">Pedidos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Atualizar Pedido</li>
            </ol>
        </nav>
    </div>
    <div class="row mt-4">
        <div class="col-md-8 mb-1">
            <h4>Pedido de Compra</h4>
            <hr>

            <div id="liveAlertPlaceholder">
            </div>

        </div>
        <div class="col-md-8">
            <div class="card text-dark">
                <div class="___class_+?9___">
                    <form>
                        @csrf
                        <div class="row p-3">
                            <div class="col-md-6 mb-2">
                                <label for="userName" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="userName" value="{{ $pedido->user->name }}"
                                    disabled>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="selectStatus" class="form-label">Status*</label>
                                <select class="form-select" id="selectStatus">
                                    <option value="">selecione um status</option>
                                    <option value="Em aberto" @if ($pedido->status === 'Em aberto') selected @endif>Em aberto</option>
                                    <option value="Pago" @if ($pedido->status === 'Pago') selected @endif>Pago</option>
                                    <option value="Cancelado" @if ($pedido->status === 'Cancelado') selected @endif>Cancelado</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="cliente" class="form-label">Cliente*</label>
                                <select class="form-select" id="selectCliente">
                                    <option value="" selected>selecione um cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" @if ($pedido->cliente_id == $cliente->id) selected @endif>{{ $cliente->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="p-3" style="background-color: #e9ecef;">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <select class="form-select" id="produto" onchange="setPreco(this)">
                                        <option value="">selecione um produto</option>
                                        @foreach ($produtos as $produto)
                                            <option value="{{ $produto->id }}" data-preco="{{ $produto->preco }}">
                                                {{ $produto->descricao }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="text" class="form-control" id="preco" placeholder="Preço" disabled>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <input type="number" min="0" class="form-control" id="quantidade"
                                        placeholder="Quantidade">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button type="button" onclick="addProdutoPedido()"
                                        class="btn btn-warning">Incluir</button>
                                </div>
                            </div>

                            <hr>

                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Qunatidade</th>
                                        <th>Valor Unit.</th>
                                        <th>Valor Total</th>
                                        <th>X</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <h4 class="total-geral"></h4>
                            </div>
                        </div>

                        <div class="col-12 p-3">
                            <button type="button" onclick="updatePedido()" class="btn btn-warning mt-2">Atualizar
                                Pedido</button>
                            <a href="javascript:history.back()" class="btn btn-danger mt-2">Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        let total = 0;
        let pedido = [];
        let selectProduto = document.getElementById('produto');
        let preco = document.getElementById('preco');
        let quantidade = document.getElementById('quantidade');
        let tbody = document.querySelector('.table tbody');
        let totalGeralDiv = document.querySelector('.total-geral');

        // Fomata para moeda BRL
        function formatMoeda(valor) {
            return valor.toLocaleString('pt-br', {
                style: 'currency',
                currency: 'BRL'
            });
        }

        // Menssagens de alerta
        function alertMessage(message, type) {
            let alertPlaceholder = document.getElementById('liveAlertPlaceholder')
            alertPlaceholder.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible" role="alert">' + message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

        }

        // set o preço ao selecionar o produto
        function setPreco(componente) {
            let preco = componente.options[componente.selectedIndex].getAttribute('data-preco');
            document.getElementById('preco').value = preco;
        }

        // insere as row na tbody da table
        function printPedido(pedido) {
            let rowTable = '';
            pedido.forEach(function(valor, indice) {
                rowTable += `
                    <tr>
                        <td>${valor.produto}</td>
                        <td>${valor.quantidade}</td>
                        <td>${formatMoeda(valor.preco)}</td>
                        <td>${formatMoeda(valor.quantidade * valor.preco)}</td>
                        <td>
                            <button type="button" class="btn btn-outline-danger btn-sm" title="Excluir" onclick="deleteProdutoPedido(${indice})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </button>
                        </td>
                    </tr>            
                `;
            });
            tbody.innerHTML = rowTable;

            // Verificar se total foi preechido para incluir na div
            parseFloat(total.toFixed(2)) > 0 ? totalGeralDiv.innerHTML = "Total: " + formatMoeda(total) : totalGeralDiv
                .innerHTML = "";
        }

        // Adiciona um item ao pedido
        function addProdutoPedido() {
            // recebe o option do select produto
            let produto = selectProduto.options[selectProduto.selectedIndex];

            if (produto.value !== '' && quantidade.value !== '') {
                // Adiciona um item ao pedido
                pedido.push({
                    'id': produto.value,
                    'produto': produto.text,
                    'quantidade': parseInt(quantidade.value),
                    'preco': parseFloat(produto.getAttribute('data-preco'))
                });
                // Soma total
                total += parseFloat(produto.getAttribute('data-preco')) * parseInt(quantidade.value);

                // Limpa os campos
                quantidade.value = '';
                preco.value = '';
                selectProduto.options[0].setAttribute('selected', 'selected');
                selectProduto.options[0].removeAttribute('selected');

                // Imprime os items do pedido
                printPedido(pedido);
            } else {
                alertMessage('Selecione um produto e quantidade', 'danger');
            }
        }

        function deleteProdutoPedido(indice) {
            // acha o objeto e armazena na variável
            let itemPedido = pedido.find(function(valor, chave) {
                return chave == indice
            });

            // Atualiza o total
            total -= itemPedido.preco * itemPedido.quantidade;

            // Remove o item do pedido pela chave
            pedido.splice(indice, 1);
            // print o pedido
            printPedido(pedido);
        }


        function updatePedido() {
            let statusPedido = document.getElementById('selectStatus').value;
            let clienteId = document.getElementById('selectCliente').value;

            if (clienteId && statusPedido && pedido.length) {
                fetch("{{ route('pedidos.update', $pedido->id) }}", {
                        method: 'PUT',
                        body: JSON.stringify({
                            clienteId: clienteId,
                            status: statusPedido,
                            itensPedido: pedido,
                            valorTotal: parseFloat(total.toFixed(2))
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            "X-CSRF-Token": document.querySelector('input[name=_token]').value
                        }
                    })
                    .then((result) => result.json())
                    .then(function(response) {
                        if (response.sucesso) {
                            alert(response.sucesso)
                        }
                        if (response.error) {
                            alertMessage(response.error, 'danger');
                        }
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            } else {
                alertMessage('Preencha todos os campos!!!', 'danger');
            }
        }


        function getItensPedido() {
            fetch("{{ route('pedidos.show', $pedido->id) }}", {
                    method: 'GET'
                })
                .then((result) => result.json())
                .then(function(response) {
                    response.map(function(data) {
                        // Preenche os itens no pedido
                        pedido.push({
                            'id': data.produto_id,
                            'produto': data.produto.descricao,
                            'quantidade': data.quantidade,
                            'preco': parseFloat(data.preco)
                        });
                        total += parseFloat(data.preco) * data.quantidade;
                    })
                    // Imprime os items do pedido
                    printPedido(pedido);
                })
                .catch((error) => {
                    console.log(error);
                })
        }
        getItensPedido();
    </script>
@endsection
