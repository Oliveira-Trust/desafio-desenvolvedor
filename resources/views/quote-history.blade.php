@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 align-items-center">
            <div class="row justify-content-center mt-3 mb-3">
                <h3>Histórico de Cotações</h3>
            </div>
            <card>
                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Moeda de Destino</th>
                            <th class="th-sm">Valor para Conversão</th>
                            <th class="th-sm">Valor Convertido</th>
                            <th class="th-sm">Valor Descontado</th>
                            <th class="th-sm">Enviar para Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($quotes as $quote)
                                <td>{{ $quote->currency ?? '' }}</td>
                                <td>R${{ $quote->value ?? '' }}</td>
                                <td>{{ $quote->finalValue ?? '' }}</td>
                                <td>R${{ $quote->discountedValue ?? '' }}</td>
                                <td class="text-center">
                                    <button class="border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                        </svg>
                                    </button>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </card>
        </div>
    </div>

    {!! $quotes->links() !!}
@endsection
