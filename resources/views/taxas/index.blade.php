@extends('layout')

@section('content')
    <div class="pricing-header p-3 pb-md-4 text-left">
        <h1 class="display-8 fw-normal">Taxas</h1>
        <p class="fs-5 text-muted">Configuração dos percentuais das taxas</p>
    </div>
    </header>

    <main>
        @if (isset($sucesso))
            <div class="alert alert-success" role="alert">
                Taxas alteradas com sucesso!
            </div>
        @endif
        <div class="row row-cols-1 row-cols-md-3 mb-3">
            <div class="col-md-12">
                <div class="card mb-4 rounded-3 shadow-sm">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ url('/taxas') }}">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-8 form-group mb-2">
                                    <h4 class="display-8 fw-normal">Pagamentos em Boleto</h4>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input name="taxa-boleto" id="taxa-boleto" type="text" class="form-control"
                                            value="{{ $taxaBoleto }}" style="text-align: right" disabled>
                                    </div>
                                </div>
                                <div class="col-8 form-group mb-2">
                                    <h4 class="display-8 fw-normal">Pagamentos em Cartão de Crédito</h4>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input name="taxa-credito" id="taxa-credito" type="text" class="form-control"
                                            value="{{ $taxaCredito }}" style="text-align: right" disabled>
                                    </div>
                                </div>
                                <div class="col-8 form-group mb-2">
                                    <h4 class="display-8 fw-normal">Valores entre 0 e 3.000,00</h4>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input name="taxa-cond1" id="taxa-cond1" type="text" class="form-control"
                                            value="{{ $taxaCond1 }}" style="text-align: right" disabled>
                                    </div>
                                </div>
                                <div class="col-8 form-group mb-4">
                                    <h4 class="display-8 fw-normal">Valores entre 3.000,01 e 100.000,00</h4>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        <input name="taxa-cond2" id="taxa-cond2" type="text" class="form-control"
                                            value="{{ $taxaCond2 }}" style="text-align: right" disabled>
                                    </div>
                                </div>
                                <div class="col-8 form-group mb-4 editar">
                                    <button id="editar" type="button"
                                        class="w-100 btn btn-lg btn-outline-primary">Editar</button>
                                </div>
                                <div class="col-8 form-group mb-4 salvar" style="display: none">
                                    <button id="salvar" type="submit" class="w-100 btn btn-lg btn-outline-primary"
                                        disabled>Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script src="{{ asset('/custom/js/taxas.js') }}"></script>
@endsection
