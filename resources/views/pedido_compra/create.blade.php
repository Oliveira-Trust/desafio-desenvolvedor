@extends('layouts.app')

@section('title', 'Novo pedido de Compra')

@section('content')
    <div class="row mt-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('pedidos.index') }}">Pedidos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Novo Pedido de Compra</li>
            </ol>
        </nav>
    </div>
    <div class="row mt-4">
        <div class="col-md-8 mb-1">
            <h4>Registrar Pedido de Compra</h4>
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
                                <input type="text" class="form-control" id="userName" value="{{ $user->name }}"
                                    disabled>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="selectStatus" class="form-label">Status*</label>
                                <select class="form-select" id="selectStatus">
                                    <option value="" selected>selecione um status</option>
                                    <option value="Em aberto">Em aberto</option>
                                    <option value="Pago">Pago</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="cliente" class="form-label">Cliente*</label>
                                <select class="form-select" id="selectCliente">
                                    <option value="" selected>selecione um cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">
                                            {{ $cliente->nome }}
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
                            <button type="button" onclick="savePedido()" class="btn btn-success mt-2">Registrar
                                Pedido</button>
                            <a href="{{ route('pedidos.index') }}" class="btn btn-danger mt-2">Cancelar</a>
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

        // set o preço ao selecionar o produto
        function setPreco(componente) {
            let preco = componente.options[componente.selectedIndex].getAttribute('data-preco');
            document.getElementById('preco').value = preco;
        }

    </script>
@endsection
