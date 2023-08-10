@extends('user::layouts.default')

@section('content')
    <div class="row row-m-1">
        <div class="col">
            @include('baseadminlte3::layouts.partials.messages')
            <div class="rbox table-content p-0">
                <div class="rbox text-right">
                    <a href="{{ route('conversion::conversion.create') }}" class="btn btn-dark disable-link"><i class="fa fa-plus"></i> Nova Conversão</a>
                </div>
                <div class="table-content-load">
                    <div class="rbox-body p-1">
                        @if ($conversions->count())
                            <div class="table-responsive">
                                <table class="table mb-1 table-hover table-striped @yield('table-class')">
                                    <thead>
                                    <tr>
                                        <th>Valor</th>
                                        <th>Conversão</th>
                                        <th>Valor Conversão</th>
                                        <th>Pagamento</th>
                                        <th>Data</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($conversions as $res)
                                        <tr>
                                            <td>{{ fm($res->currency_origin_value, currency: $res->currency_origin_symbol) }}</td>
                                            <td>{{ $res->currency_origin_name .'-'. $res->currency_destiny_name }}</td>
                                            <td>{{ fm($res->currency_destiny_conversion,currency: $res->currency_origin_symbol) }}</td>
                                            <td>{{ $res->payment_type }}</td>
                                            <td>{{ $res->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('conversion::conversion.show', $res) }}" class="btn btn-default btn-xs"> Visualizar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center p-5 highlight-igone">
                                <br>
                                @if ($seach = request('s'))
                                    <h3>Nenhum registro encontrado com: <br>
                                        <b>{{ $seach }}</b>
                                    </h3>
                                @else
                                    <h3>Nenhum registro encontrado</h3>
                                @endif
                            </div>
                        @endif
                    </div>


                    @if ($conversions->count())
                        <div class="rbox-footer p-1 pl-3">
                            <div class="row">
                                <div class="col align-self-center">
                                    <small class="text-muted">Mostrando {{ $conversions->firstItem() }} a {{ $conversions->lastItem() }} de {{ $conversions->total() }} {{ strtolower($name ?? route_name())}}</small>
                                </div>
                                <div class="col-auto align-self-center">
                                    {!! $conversions->appends(Request::all())->render() !!}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
