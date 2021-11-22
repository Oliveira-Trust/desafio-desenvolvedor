@extends('welcome')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                @if(Session::has('msg'))
                    <div class = "alert alert-success text-center mt-5">
                        {!! Session::get("msg") !!}
                    </div>
                @endif
                <a href = "{{ route('show.cotacao') }}" class = "btn btn-success">Consultar cotação</a>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
            </div>
            <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>
                            Moeda de Origem
                        </th>
                        <th>
                            Moeda de Destino
                        </th>
                        <th style="width: 8%" class="text-center">
                        Taxa de conversão
                        </th>
                        <th style="width: 20%; text-align: center;">
                            Forma de pagamento
                        </th>
                        <th style="width: 20%; text-align: center;">
                            Taxa de forma de pagamento
                        </th>
                        <th style="width: 20%; text-align: center;">
                            Valor cotado
                        </th>
                        <th style="width: 20%; text-align: center;">
                            Valor total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cotacaos as $cotacao)
                        <tr>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->moeda_origem }}
                                </a>
                            </td>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->taxa_conversao }}
                                </a>
                            </td>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->forma_pagamento }}
                                </a>
                            </td>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->taxa_forma_pagamento }}
                                </a>
                            </td>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->valor_liquido }}
                                </a>
                            </td>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->valor_bruto }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
