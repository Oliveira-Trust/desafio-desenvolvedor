@extends('layout')

@section('content')
<div class="pricing-header p-3 pb-md-4 text-left">
    <h1 class="display-8 fw-normal">Cambio</h1>
    <p class="fs-5 text-muted">Preencha os campos para a realização da transação</p>
</div>
</header>

<main>
    <div class="row row-cols-1 row-cols-md-3 mb-3">
        <div class="col-md-12">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ url('/') }}">
                        @csrf
                        <div class="row justify-content-center">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="col-8 form-group mb-2">
                                <h4 class="display-8 fw-normal">Moeda Origem</h4>
                                <select name="moeda_origem_id" id="origem" class="form-select">
                                    @foreach ($moedasOrigem as $mo)
                                    <option value="{{ $mo->id }}" data-sigla="{{ $mo->sigla }}">{{ $mo->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-8 form-group mb-2">
                                <h4 class="display-8 fw-normal">Moeda Destino</h4>
                                <select name="moeda_destino_id" id="destino" class="form-select mb-2">
                                    <option value="">Selecione...</option>
                                    @foreach ($moedasDestino as $mo)
                                    <option value="{{ $mo->id }}" data-sigla="{{ $mo->sigla }}">{{ $mo->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="valor_moeda_destino" id="valor-moeda-destino" value="">
                            <div class="col-8 form-group mb-2">
                                <h4 class="display-8 fw-normal">Forma de Pagamento</h4>
                                <select name="forma_id" id="forma" class="form-select mb-2">
                                    <option value="">Selecione...</option>
                                    @foreach ($formas as $f)
                                    <option value="{{ $f->id }}">{{ $f->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-8 form-group mb-4">
                                <h4 class="display-8 fw-normal">Valor</h4>
                                <input name="valor_conversao" id="valor" class="form-control mb-2" placeholder="Valores entre 1.000,00 e 100.000,00">
                            </div>
                            <div class="col-8 form-group mb-4">
                                <button type="submit" class="w-100 btn btn-lg btn-outline-primary">Converter</button>
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
<script src="{{ asset('/custom/js/cambio.js') }}"></script>
@endsection