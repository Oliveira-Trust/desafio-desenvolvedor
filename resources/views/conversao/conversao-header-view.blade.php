<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Conversor de Moedas') }}
        </h2>
    </x-slot>
    <div class="container" style="max-width: 90%; padding: 2em">
        <div class="card">
            <div class="card-header" style="padding: 2em">
                <form id="myForm">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="valorInicial">Valor</label>
                            <input type="text" name="valorInicial" id="valorInicial" class="form-control" placeholder="0,00"
                                   style="text-align: right" min="0">
                        </div>
                        <div class="col-md-2">
                            <label for="moedaInicial">Converter De</label>
                            <select id="moedaInicial" class="form-control" name="moedaInicial">
                                <option value="4">Real (BRL)</option>
                            </select>
                        </div>
                        <div class="col-md-1 align-self-end">
                            <div class="row justify-content-center">
                                <button disabled type="button" class="btn btn-lg" style="background: none;border:none">
                                    <i class="bi bi-arrow-right" style="color: black;font-size: 1.5em"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="moedaDestino">Para</label>
                            <select id="moedaDestino" class="form-control" name="moedaDestino">
                                @foreach($moedas as $moeda)
                                    @if($moeda->id != 4)
                                        <option value="{{$moeda->id}}">{{$moeda->nome_moeda}}
                                            ({{$moeda->abreviacao_moeda}})
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tipoPagamento">Tipo de pagamento</label>
                            <select class="form-control" name="tipoPagamento" id="tipoPagamento">
                                @foreach($tiposPagamento as $tipoPagamento)
                                    <option value="{{$tipoPagamento->id}}">{{$tipoPagamento->tipo_pagamento}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 align-self-end">
                            <div class="row justify-content-center">
                                <button id="converter" type="button" class="btn btn-primary btn-lg"
                                        onclick="submitForm()">
                                    <span style="font-size:0.8em">Converter <i class="bi bi-arrow-clockwise"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="conversao-body-view-result" class="row panel">
            <div class="panel-body">
                <div id="conversao-body">
                </div>
            </div>
        </div>
        @include('conversao.conversao-footer-view')
    </div>
</x-app-layout>

<script>
    function submitForm() {
        let valorInicial  = $("#valorInicial").val()
        let moedaInicial  = $("#moedaInicial").val()
        let moedaDestino  = $("#moedaDestino").val()
        let tipoPagamento = $("#tipoPagamento").val()

        valorInicial = parseFloat(valorInicial.replace('.','').replace(',','.').replace(/ /g, ""));
        $.ajax({
            type: "POST",
            url: `{{route('converter')}}`,
            data: {valorInicial, moedaInicial, moedaDestino, tipoPagamento},
            success: (data) => {
                $('#conversao-body').html(data)
                atualizaHistorico();
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            error: (error) => {
                let erros = error.responseJSON.errors
                $.each(erros, function (erro, i) {
                    Swal.fire({
                        position: 'top-end',
                        text: i,
                        icon: 'error',
                        timer: 1500,
                        showConfirmButton: false,
                    })
                });
            }
        });
    }

    $(document).ready(function() {
        $("#valorInicial").maskMoney({
            thousands: '. ',
            decimal: ', ',
        });
    })
</script>
