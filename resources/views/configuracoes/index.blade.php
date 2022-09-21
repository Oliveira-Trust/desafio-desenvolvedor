@extends('layout.app')

@section('titulo', 'Configurações')

@section('conteudo')
    @if (Session::has('alert-success'))
        <div class="alert alert-success">
            {{ Session::get('alert-success') }}
        </div>
    @endif
    <form action="{{ route('configuracoes.update', $configuracoes->id) }}" method="post" class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">

                <div class="form-group row">
                    <label for="taxa_boleto" class="col-md-2 col-form-label">Taxa Boleto</label>
                    <div class="col-md-2">
                        <input type="text" name="taxa_boleto" id="taxa-boleto" class="form-control" value="{{ $configuracoes->taxa_boleto }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="taxa_cartao" class="col-md-2 col-form-label">Taxa Cartão</label>
                    <div class="col-md-2">
                        <input type="text" name="taxa_cartao" id="taxa_cartao" class="form-control" value="{{ $configuracoes->taxa_cartao }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="taxa_conversao_abaixo_3mil" class="col-md-2 col-form-label">Taxa Conversão Abaixo de 3 mil</label>
                    <div class="col-md-2">
                        <input type="text" name="taxa_conversao_abaixo_3mil" id="taxa_conversao_abaixo_3mil" class="form-control" value="{{ $configuracoes->taxa_conversao_abaixo_3mil }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="taxa_conversao_acima_3mil" class="col-md-2 col-form-label">Taxa Conversão Acima de 3 mil</label>
                    <div class="col-md-2">
                        <input type="text" name="taxa_conversao_acima_3mil" id="taxa_conversao_acima_3mil" class="form-control" value="{{ $configuracoes->taxa_conversao_acima_3mil }}">
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button class="btn btn-primary offset-md-2">Salvar</button>
            </div>
        </div>
    </form>


@endsection
