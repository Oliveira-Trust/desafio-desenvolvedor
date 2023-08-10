@extends('user::layouts.default')

@section('content')
    <div class="row row-m-1">
        <div class="col">
            @include('baseadminlte3::layouts.partials.messages')
            <div class="rbox table-content p-0">
                <div class="rbox text-right">
                    <a href="{{ route('conversion::config.tax.create') }}" class="btn btn-dark disable-link"><i class="fa fa-plus"></i> Novo</a>
                </div>
                <div class="table-content-load">
                    <div class="rbox-body p-1">
                        @if ($conversionTaxs->count())
                            <div class="table-responsive">
                                <table class="table mb-1 table-hover table-striped @yield('table-class')">
                                    <thead>
                                    <tr>
                                        <th>Valor Mínimo</th>
                                        <th>Valor Máximo</th>
                                        <th>Taxa (%)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($conversionTaxs as $res)
                                        <tr>
                                            <td>{{ fm($res->min, currency: 'R$') ?? '-' }}</td>
                                            <td>{{ fm($res->max, currency: 'R$') ?? '-' }}</td>
                                            <td>{{ str_replace('.', ',', $res->value) .'%' }}</td>
                                            <td>
                                                <a data-toggle="confirm-link" href="{{ route('conversion::config.tax.edit', $res) }}"><i class="fa fa-edit"></i></a>
                                                <a data-toggle="confirm-link" href="{{ route('conversion::config.tax.delete', $res) }}"><i class="fa fa-trash"></i></a>
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


                    @if ($conversionTaxs->count())
                        <div class="rbox-footer p-1 pl-3">
                            <div class="row">
                                <div class="col align-self-center">
                                    <small class="text-muted">Mostrando {{ $conversionTaxs->firstItem() }} a {{ $conversionTaxs->lastItem() }} de {{ $conversionTaxs->total() }} {{ strtolower($name ?? route_name())}}</small>
                                </div>
                                <div class="col-auto align-self-center">
                                    {!! $conversionTaxs->appends(Request::all())->render() !!}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
