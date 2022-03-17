@extends('layout')

@section('content')
<div class="pricing-header p-3 pb-md-4 text-left">
    <h1 class="display-8 fw-normal">Histórico</h1>
    <p class="fs-5 text-muted">Todos os cambios realizados</p>
</div>
</header>

<main>
    <div class="row row-cols-1 row-cols-md-3 mb-3">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Valor p/ Conversão</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Forma</th>
                        <th scope="col">Valor Comprado</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cambios as $cambio)
                        <tr>
                            <th scope="row">{{ $cambio->id }}</th>
                            <td>{{ $cambio->origem_sigla }} {{ number_format($cambio->valor_conversao, 2, ',', '.') }}</td>
                            <td>{{ $cambio->origem_sigla . '->' . $cambio->destino_sigla}}</td>
                            <td>{{ $cambio->forma_descricao }}</td>
                            <td>{{ $cambio->destino_sigla }} {{ number_format($cambio->valor_comprado, 2, ',', '.') }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ url('/detalhe/' . $cambio->id ) }}">Detalhes</a>
                            </td>
                        </tr
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if ($cambios->total() > 15)
    <div class="d-flex justify-content-center">
        {{ $cambios->links('paginate', ["paginator" => $cambios->links()]) }}
    </div>        
    @endif
</main>
@endsection