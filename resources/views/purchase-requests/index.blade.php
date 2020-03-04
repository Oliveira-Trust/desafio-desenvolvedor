@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Pedidos de Compra</h2>
    
    <a href="{{ route('purchase-requests.create') }}" class="btn btn-info text-white mb-4"><i class="fa fa-plus"></i> Novo Pedido</a>
    <a href="#" class="btn btn-danger mb-4 excluir-selecionados" style="display: none;">Excluir Selecionados</a>
    
    <div class="table-responsive">
        <table class="table table-bordered nowrap" id="dataTable">
            <thead class="bg-info text-white">
                <tr>
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>R$ Total</th>
                    <th>Status</th>
                    <th>Ações</th>
                    <th class="text-center">
                        <input type="checkbox" id="marcar-desmarcar" />
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->client()->name }}</td>
                    <td>{{ $request->product()->name }}</td>
                    <td class="maskMoney">{{ $request->product()->price }}</td>
                    <td>{{ $request->quantity }}</td>
                    <td class="maskMoney">{{ $request->price_total }}</td>
                    <td>{{ $status[$request->status] }}</td>
                    <td class="text-center">
                        <form action="{{ route('purchase-requests.destroy', ['id' => $request->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            
                            <a href="{{ route('clients.show', ['id' => $request->client()->id]) }}" class="btn btn-info text-white" title="Detalhes do Cliente"><i class="fa fa-search"></i></a>
                            <a href="{{ route('purchase-requests.edit', ['id' => $request->id]) }}" class="btn btn-info text-white" title="Editar"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger" title="Excluir"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                    <td class="checkbox-clients text-center">
                        <input type="checkbox" class="marcar" name="requests[]" value="{{ $request->id }}" />
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $('.excluir-selecionados').on('click', function(e) {
            
        e.preventDefault();
        var requests = [];

        $('.marcar:checked').each(function() {
            requests.push(this.value);
        });

        $.ajax({
            url: '{{ route("purchase-requests.destroy-selected") }}',
            type: "post",
            data: {
                ids: requests,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
               window.location.reload();
            }
        });
    });
</script>
@endsection
