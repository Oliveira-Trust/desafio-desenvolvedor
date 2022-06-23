<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel de Configuração de Taxa') }}
        </h2>
    </x-slot>
    <div class="container" style="max-width: 90%; padding: 2em">
        <div class="card">
            <div class="card-body" style="padding: 2em">
                <h3> Taxas Configuradas </h3>
                <div class="row">
                    <div class="col">
                        <div class="card-deck mb-3" style="border: solid black;padding: 1em;height: 100%">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Valor Limite</th>
                                    <th scope="col">Taxa abaixo do valor limite</th>
                                    <th scope="col">Taxa acima do valor limite</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($taxaConversao as $taxa)
                                    <form id="formTaxaConversao">
                                        <input name="conversaoID"  id="conversaoID" value="{{$taxa['id']}}" type="text" class="inputConversao{{$taxa['id']}}" hidden>
                                        <input type="hidden" name="_token" id="token" class="inputConversao{{$taxa['id']}}" value="{{ csrf_token() }}">
                                        <tr class="text-center">
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" id="btnGroupAddon">R$</div>
                                                    </div>
                                                    <input type="text" name="valorLimite" id="valorLimite" class="form-control inputConversao{{$taxa['id']}} mask" placeholder="Valor limite" value={{$taxa['valor_limite']}}>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input id="taxaAbaixo" name="taxaAbaixo" type="text" class="form-control inputConversao{{$taxa['id']}} mask" placeholder="Taxa porcentagem" value={{$taxa['taxa_abaixo']*100}}>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" id="btnGroupAddon">%</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <input id="taxaAcima" name="taxaAcima"  type="text" class="form-control inputConversao{{$taxa['id']}} mask" placeholder="Taxa porcentagem" value={{$taxa['taxa_acima']*100}}>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" id="btnGroupAddon">%</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button id="editaConversao{{$taxa['id']}}" type="button" class="btn btn-sm btn-success editaConversao" data-toggle="modal" onclick="editaTaxa({{$taxa['id']}})"><i class="bi-pencil"></i></button>
                                                <button id="salvaConversao{{$taxa['id']}}" type="submit" class="btn btn-sm btn-success salva" data-toggle="modal"><i class="bi-check"></i></button>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-deck mb-3" style="border: solid black;padding: 1em;height: 100%">
                            <h4>Taxas de método de pagamento</h4>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Tipo Pagamento</th>
                                    <th scope="col">Taxa</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tiposPagamento as $tipoPagamento)
                                    <form id="formTaxaPagamento">
                                        <input name="id" id="pagamentoID{{$tipoPagamento['id']}}" value="{{$tipoPagamento['id']}}" type="text" class="input{{$tipoPagamento['id']}}" hidden>
                                        <input type="hidden" name="_token" id="token" class="input{{$tipoPagamento['id']}}" value="{{ csrf_token() }}">
                                        <tr class="text-center">
                                            <td >{{$tipoPagamento['tipo_pagamento']}}</td>
                                            <td>
                                                <div class="input-group">
                                                    <input id="taxa{{$tipoPagamento['id']}}" name="taxa" type="text" class="form-control input{{$tipoPagamento['id']}} mask" placeholder="Taxa porcentagem" value='{{($tipoPagamento['valor_taxa'])*100}}'/>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" id="btnGroupAddon">%</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button id="edita{{$tipoPagamento['id']}}" type="button" class="btn btn-sm btn-success edita" data-toggle="modal" onclick="editaPagamento({{$tipoPagamento['id']}})"><i class="bi-pencil"></i></button>
                                                <button id="salva{{$tipoPagamento['id']}}" type="submit" class="btn btn-sm btn-success salva" data-toggle="modal" onclick="submitFormPagamento({{$tipoPagamento['id']}})"><i class="bi-check"></i></button>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>


<script>
    function editModalConversao(id){
        $('#taxaConversaoModal').modal('show');
    }

    $(document).ready(function() {
        $('input').prop('disabled', true);
        $('.salva').hide();
    });

    function editaTaxa(id){
        $('.inputConversao'+id).prop('disabled', false)
        $("#salvaConversao"+id).show();
        $('#editaConversao'+id).hide();
    }

    $('#formTaxaConversao').submit(function(event){
      event.preventDefault();
        let id = $("#conversaoID").val()
        let valorLimite = treatVal($("#valorLimite").val())
        let taxaAbaixo = treatVal($("#taxaAbaixo").val())
        let taxaAcima = treatVal($("#taxaAcima").val())

        $('.salvar').prop('disabled', true);
        $.ajax({
            type: "POST",
            url: "{{route('salva-taxa-conversao')}}",
            data: {id, valorLimite, taxaAbaixo, taxaAcima},
            success: (data) => {
                $('input').prop('disabled', true);
                window.location.reload()
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
    });

    function editaPagamento(id){
        $('.input'+id).prop('disabled', false)
        $("#salva"+id).show();
        $('#edita'+id).hide();
    }

    function submitFormPagamento(id) {
        let taxa = treatVal($("#taxa"+id).val());

        $.ajax({
            type: "POST",
            url: "{{route('salva-taxa-pagamento')}}",
            data: { taxa, id},
            success: (data) => {
                $('input').prop('disabled', true);
                window.location.reload()
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
        $(".mask").maskMoney({
            thousands: '. ',
            decimal: ', ',
        });
    })

    function treatVal(val){
        return parseFloat(val.replace('.','').replace(',','.').replace(/ /g, ""));
    }
</script>
