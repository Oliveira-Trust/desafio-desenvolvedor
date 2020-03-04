@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Clientes</h2>
    
    <a href="{{ route('clients.create') }}" class="btn btn-info text-white mb-4"><i class="fa fa-plus"></i> Novo Cliente</a>
    <a href="#" class="btn btn-danger mb-4 excluir-selecionados" style="display: none;">Excluir Selecionados</a>
    
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable">
            <thead class="bg-info text-white">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Data Nascimento</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                    <th class="text-center">
                        <input type="checkbox" id="marcar-desmarcar" />
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td><?= date('d/m/Y', strtotime($client->datebirth)); ?></td>
                    <td class="maskCpf">{{ $client->cpf }}</td>
                    <td class="maskTel">{{ $client->telephone }}</td>
                    <td class="text-center">
                        <form action="{{ route('clients.destroy', ['id' => $client->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('clients.edit', ['id' => $client->id]) }}" class="btn btn-info text-white" title="Editar"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-danger" title="Excluir"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                    <td class="checkbox-clients text-center">
                        <input type="checkbox" class="marcar" name="clients[]" value="{{ $client->id }}" />
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
        var clients = [];

        $('.marcar:checked').each(function() {
            clients.push(this.value);
        });

        $.ajax({
            url: '{{ route("clients.destroy-selected") }}',
            type: "post",
            data: {
                ids: clients,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
               window.location.reload();
            }
        });
    });
</script>
@endsection
