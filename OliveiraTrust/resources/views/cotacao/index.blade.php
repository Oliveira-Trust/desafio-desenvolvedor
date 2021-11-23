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
            <table align="center" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;" class="table table-striped projects">
                <thead>
                    <tr>
                        <th>
                            Moeda de Origem
                        </th>
                        <th>
                            Moeda de Destino
                        </th>
                        <th >
                        Taxa de conversão(Reais)
                        </th>
                        <th>
                            Forma de pagamento
                        </th>
                        <th>
                            Valor da moeda cotada
                        </th>
                        <th>
                            Taxa de forma de pagamento(Reais)
                        </th>
                        <th>
                            Valor cotado
                        </th>
                        <th>
                            Valor total(Reais)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cotacoes as $cotacao)
                        <tr>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->moeda_origem }}
                                </a>
                            </td>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->moeda_destino }}
                                </a>
                            </td>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->taxa_conversao }}
                                </a>
                            </td>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->forma_pagamento  }}
                                </a>
                            </td>
                            <td style = "width: 10%;">
                                <a>
                                    {{ $cotacao->valor_moeda_destino  }}
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
