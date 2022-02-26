@extends('dashboard.templates.app')

@section('content-dash')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Dashboard</h2>
        
            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Dashboard</span></li>
                </ol>
        
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">COTAÇÃO DE MOEDAS DOS ÚLTIMOS 30 DIAS</h2>
                    </header>
                    <div class="panel-body">
                        <form action="/dashboard">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <div class="input-group mb-md">
                                        <select name="code" class="form-control">
                                            @foreach (\App\Models\Coin::all() as $coin)
                                                @if ($coin->acronym === request()->get('code'))
                                                    <option value="{{ $coin->acronym }}" selected>{{ $coin->acronym }}</option>
                                                @else
                                                    <option value="{{ $coin->acronym }}">{{ $coin->acronym }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary">BUSCAR!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>MÉDIA</th>
                                    <th>BAIXA</th>
                                    <th>VARIAÇÃO</th>
                                    <th>PORCENTAGEM DE VARIAÇÃO</th>
                                    <th>VALOR COMPRA</th>
                                    <th>VALOR VENDA</th>
                                    <th>DATA DE COTAÇÃO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quotes as $quote)
                                    <tr>
                                        <td>{{ $quote['high'] ?? '--' }}</td>
                                        <td>{{ $quote['low'] ?? '--' }}</td>
                                        <td>{{ $quote['varBid'] ?? '--' }}</td>
                                        <td>{{ $quote['pctChange'] ?? '--' }}</td>
                                        <td>{{ $quote['bid'] ?? '--' }}</td>
                                        <td>{{ $quote['ask'] ?? '--' }}</td>
                                        <td>{{ $quote['create_date'] ?? '--' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    
    <!-- Theme Base, Components and Settings -->
    <script src="/assets/javascripts/theme.js"></script>
    
    <!-- Theme Custom -->
    <script src="/assets/javascripts/theme.custom.js"></script>
@endsection