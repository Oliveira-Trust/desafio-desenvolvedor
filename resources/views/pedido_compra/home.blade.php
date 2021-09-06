@extends('layouts.app')

@section('title', 'Pedidos de Compra')

@section('content')
    <div class="row mt-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pedido de Compra</li>
            </ol>
        </nav>
    </div>

    <div class="row mt-4">
        <div class="col-md-10 mb-1">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Pedidos de Compra</h4>
                <a href="{{ route('pedidos.create') }}" class="btn btn-success">Novo Pedido de Compra</a>
            </div>
            <hr>
        </div>
        <div class="col-md-10">

            <div class="card text-dark mb-3">
                <div class="card-body table-responsive">
                    <button type="button" onclick="massDelete()" id="btnExcluir"
                        class="d-none btn btn-sm btn-danger">Excluir</button>
                    <table class="table table-hover" id="table-custom">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Cliente</th>
                                <th>Usuário</th>
                                <th>Valor Total</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $pedido)
                                <tr>
                                    <td><input type="checkbox" class="checkbox" onchange="addIdToList()"
                                            name="{{ $pedido->id }}" id="{{ $pedido->id }}"></td>
                                    <td><a
                                            href="{{ route('clientes.edit', $pedido->cliente->id) }}">{{ $pedido->cliente->nome }}</a>
                                    </td>
                                    <td>{{ $pedido->user->name }}</td>
                                    <td>{{ 'R$ ' . number_format($pedido->valor_total, 2, ',', '.') }}</td>
                                    <td>{{ $pedido->status }}</td>
                                    <td>{{ $pedido->created_at }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('pedidos.edit', $pedido->id) }}" title="Editar"
                                                class="me-1 btn btn-outline-warning btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('pedidos.destroy', $pedido->id) }}"
                                                onclick="return confirm('Tem certeza que deseja excluir?')" method="post"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm" title="Deletar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="d-flex justify-content-end">
                {{ $pedidos->links() }}
            </div> --}}
        </div>
    @endsection

    @section('script')
        <script>
            let checkTodos = document.getElementById('checkTodos');
            let btnExcluir = document.getElementById('btnExcluir');
            let checkboxes = document.querySelectorAll('.checkbox');
            let listaIds = null;

            // Datatable
            let table = new DataTable('#table-custom', {
                "order": [
                    [1, "asc"]
                ]
            });

            // Verificar se existe checkbox checado e guarda na lista 
            function addIdToList() {
                let lista = [];
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        lista.push(checkbox.id)
                    }
                });
                listaIds = lista;
                // verifica para exibir  botão excluir
                if (listaIds && listaIds.length > 0) {
                    btnExcluir.classList.remove('d-none');
                    btnExcluir.classList.add('d-block');
                } else {
                    btnExcluir.classList.remove('d-block');
                    btnExcluir.classList.add('d-none');
                }
            }

            // Delele os items checado
            async function massDelete() {
                try {
                    let requisicao = await fetch("{{ route('pedidos.index') }}/null", {
                        method: 'DELETE',
                        body: JSON.stringify({
                            ids: listaIds
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            "X-CSRF-Token": document.querySelector('input[name=_token]').value
                        }
                    })
                    let response = await requisicao.json();
                    document.location.reload();
                } catch (error) {
                    console.error(error);
                }
            }
        </script>
    @endsection
