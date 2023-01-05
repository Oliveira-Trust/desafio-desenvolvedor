@extends('layouts.master')

@section('h1', 'Conversão de Moedas')

@section('content')
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Opa!</h5>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dados para Conversão</h3>
        </div>
        <form id="consultar" action="{{ route('conversor') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Selecione uma moeda</label>
                    <select name="moeda" class="form-control">
                        <option value="">Selecione</option>
                        @foreach($moedas as $moeda)
                            <option value="{{ $moeda['sigla'] }}">{{ $moeda['sigla'] }} - {{ $moeda['nome'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Valor para Conversão</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R$</span>
                        </div>
                        <input type="text" class="form-control money" name="valor" placeholder="Insira um valor entre R$ 1.000 e R$ 100.000" value="{{ old('valor') }}">
                        <div class="input-group-append">
                            <span class="input-group-text">,00</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="">Forma de Pagamento</label>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="boleto" name="pagamento" value="boleto" {{ old('pagamento') === 'boleto' ? 'checked' : '' }}>
                            <label for="boleto" class="custom-control-label">Boleto</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="cartao" name="pagamento" value="cartao" {{ old('pagamento') === 'cartao' ? 'checked' : '' }}>
                            <label for="cartao" class="custom-control-label">Cartão de Crédito</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-info consultar">Consultar</button>
            </div>
        </form>
    </div>

    <div id="transacao" class="col-md-12" style="display: none;">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Informações da Cotação</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                    <strong><i class="fas fa-coins mr-1"></i>Dados Enviados</strong>
                    <div class="text-muted">
                        <ul class="list-unstyled">
                            <li>Moeda Origem: BRL</li>
                            <li>Moeda Destino: <span id="destino"></span></li>
                            <li>Valor: <span id="valor"></span></li>
                            <li>Forma de Pagamento: <span id="pagamento_tipo"></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <strong><i class="far fa-file-alt mr-1"></i>Detalhes da Transação</strong>
                    <div class="text-muted">
                        <ul class="list-unstyled">
                            <li>Taxa de Pagamento: <span id="taxa_pagamento"></span></li>
                            <li>Taxa de Conversão: <span id="taxa_conversao"></span></li>
                            <li>Valor final da transação: <span id="valor_convertido"></span></li>
                            <li>Valor da Moeda: <span id="valor_moeda"></span></li>
                            <li>Total Comprado da Moeda: <span id="moeda_comprada"></span></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script>
    $(document).ready(function() {
        $('#consultar').on('submit', function (e) {
            e.preventDefault();

            let endpoint = $(this).attr('action'),
                method   = $(this).attr('method'),
                data     = $(this).serialize()

            $.ajax({
                url: endpoint,
                type: method,
                data: data,
                beforeSend: function () {
                    $('#transacao').fadeOut();
                },
                success: function (xhr) {
                    let info = xhr.data;
                    $('#transacao').fadeIn();

                    $('#destino').html(info.destino);
                    $('#valor').html(info.valor.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
                    $('#pagamento_tipo').html(info.pagamento_tipo);
                    $('#taxa_pagamento').html(info.taxas.pagamento.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
                    $('#taxa_conversao').html(info.taxas.conversao.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
                    $('#valor_convertido').html(info.valor_convertido.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
                    $('#valor_moeda').html(info.valor_moeda.toLocaleString('pt-br',{style: 'currency', currency: info.destino}));
                    $('#moeda_comprada').html(info.moeda_comprada.toLocaleString('pt-br',{style: 'currency', currency: info.destino}));
                },
                error: function (xhr, json, errorThrown) {
                    let errors = xhr.responseJSON.errors,
                        errorsHtml = '';

                    $.each(errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });

                    toastr.error( errorsHtml);
                }
            });
        });
    });
</script>
@endsection
