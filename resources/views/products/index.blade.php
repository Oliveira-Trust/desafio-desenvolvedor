@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Produtos</h2>
    
    <a href="{{ route('products.create') }}" class="btn btn-info text-white mb-4"><i class="fa fa-plus"></i> Novo Produto</a>
    <a href="#" class="btn btn-danger mb-4 excluir-selecionados" style="display: none;">Excluir Selecionados</a>
    
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable">
            <thead class="bg-info text-white">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>R$ Preço</th>
                    <th>Ações</th>
                    <th class="text-center">
                        <input type="checkbox" id="marcar-desmarcar" />
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="maskMoney">{{ $product->price }}</td>
                    <td class="text-center">
                        <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-info text-white" title="Editar"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger" title="Excluir"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                    <td class="checkbox-clients text-center">
                        <input type="checkbox" class="marcar" name="products[]" value="{{ $product->id }}" />
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
        var products = [];

        $('.marcar:checked').each(function() {
            products.push(this.value);
        });

        $.ajax({
            url: '{{ route("products.destroy-selected") }}',
            type: "post",
            data: {
                ids: products,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
               window.location.reload();
            }
        });
    });
</script>
@endsection

