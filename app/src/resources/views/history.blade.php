@extends('master', ['pageHeaderTitle' => 'Histórico'])

@section('stylesheets')
    <link rel="stylesheet" href="{{ mix('css/pages/history.css') }}">
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <table class="table table-sm table-bordered history-table">
                <thead>
                    <th>Moeda de Origem</th>
                    <th>Moeda de Destino</th>
                    <th>Valor para conversão</th>
                    <th>Forma de pagamento</th>
                    <th>Valor usado para conversão</th>
                    <th>Valor comprado</th>
                    <th>Taxa de pagamento</th>
                    <th>Taxa de conversão</th>
                    <th>Valor utilizado para conversão descontando as taxas</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/pages/history.js') }}"></script>
@endsection
