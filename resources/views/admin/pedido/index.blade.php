@extends('layout_admin')
@section('pagina_titulo', 'OliveiraStore Admin - Pedidos')

@section('pagina_conteudo')
    <div class="container">
        <div class="row">
            <h3>Pedidos</h3>
            @if (Session::has('admin-mensagem-sucesso'))
                <div class="card-panel green"><strong>{{ Session::get('admin-mensagem-sucesso') }}<strong></div>
            @endif
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Realizado Em</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total_pedido = 0;
                @endphp
                @foreach ($pedidos as $pedido)
                    <?php
                    if ($pedido->status == 'RE') {
                        $Status = 'Em Aberto';
                    } elseif ($pedido->status == 'CA') {
                        $Status = 'Cancelado';
                    } else {
                        $Status = 'Concluída';
                    }
                    ?>
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $Status }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection