@extends('layouts.app')
@section('content')


<div class="card-header">{{ __('Listagem de Formas de Pagamento:') }}</div>

@if (session('status'))
<div class="alert alert-success">{{ session('status') }}</div>
@endif

<div class="d-grid gap-2 d-md-flex justify-content-md-end m-t-30">
    <a href="{{ route('formas.pag.novo')}}" class="btn btn-primary me-md-2" type="button">Nova Forma de Pagamento</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Taxa</th>
            <th style="text-align: center;" scope="col text-center">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($formas as $forma)
        <tr>
            <th scope="row">{{ $forma->id }}</th>
            <td>{{ $forma->nome }}</td>
            <td>{{ $forma->taxa }}</td>
            <td class="text-center">
                <a href="{{ route('formas.pag.edit', $forma->id) }}">Editar</a> |
                <a data-bs-toggle="modal" data-bs-target="#excluirModal" href="javascript:void(0)" onclick="confirmarModal({{$forma->id}})">Excluir</a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex">
    {{ $formas->links() }}
</div>


<!-- Modal -->
<div class="modal fade" id="excluirModal" tabindex="-1" aria-labelledby="excluirModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="modal" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="excluirModalLabel">Excluir Moeda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir essa moeda?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Excluir</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $url = "{{ route('formas.pag.destroy', 0) }}";
    $url = $url.split('/0')[0];

    function confirmarModal(id) {
        $('#modal').attr('action', $url + '/' + id);
    }
</script>
@endsection
