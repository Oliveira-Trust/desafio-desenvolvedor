@extends('layouts.app')

@section('content')
<div class="container">
    <main>

        <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Consultas Anteriores</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm table-striped" id="consultasAnteriores">

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5 text-center">
            <h2>Conversor de moedas</h2>
        </div>
        <div class="row g-5">
            <div class="col-md-10">
                <form method="POST" name="converteMoeda" id="converteMoeda">
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Valor (R$)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control money" id="dinheiro" name="dinheiro">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Moeda Destino</label>
                        <div class="col-sm-10">
                            <select name="moeda" id="moeda" class="form-control">
                                <option value="USD">USD</option>
                                <option value="EUR">EURO</option>
                            </select>
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Forma Pagamento</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="formaPagamento" id="formaPagamento" value="0" checked>
                                <label class="form-check-label" for="formaPagamento1">
                                    Boleto
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="formaPagamento" id="formaPagamento2" value="1">
                                <label class="form-check-label" for="formaPagamento2">
                                    Cartão de crédito
                                </label>
                            </div>
                        </div>
                    </fieldset>


                    <hr class="my-4">
                    <button type="submit" class="btn btn-primary " id="converter">Converter</button>
                    <button type="button" class="btn btn-success" id="consultasAnterioresButton" data-toggle="modal" data-target="#modalDetail">
                        Consultas Anteriores
                    </button>
                </form>

                <table class="table table-sm table-dark mt-5" id="retornoAPI">

                </table>

            </div>


            <div class="alert  alert-dismissible fade d-none show  messageBox mt-4" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

        </div>


    </main>
    <script src="/js/app.js"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

            $('.money').mask('###0,00', {
                reverse: true
            });

            $("#consultasAnterioresButton").click(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })
                $.ajax({
                    url: "{{ route('consultas_anteriores') }}",
                    type: "GET",
                    dataType: 'json',
                    beforeSend: function() {
                        $('#consultasAnteriores tr').remove();
                    },
                    success: function(data) {
                        console.log(data);
                        var item = "";

                        $.each(data, function(i, items) {
                            item += '<thead class="thead-dark"><th scope="col">#</th><th scope="col">Resultado</th></thead><tbody>';
                            item += '<tr><td>Moeda de origem:</td><td> ' + data[i].codein + '</td>';
                            item += '<tr><td>Moeda de destino:</td><td> ' + data[i].code + '</td>';
                            item += '<tr><td>Valor para conversão:</td><td> R$ ' + data[i].valorCotado + ' </td>';
                            item += '<tr><td>Forma de pagamento:</td><td> ' + data[i].opcaoContra + '</td>';
                            item += '<tr><td>Valor da "Moeda de destino" usado para conversão:</td><td> R$ ' + data[i].moedaDestino + ' </td>';
                            item += '<tr><td>Valor comprado em "Moeda de destino":</td><td> ' + data[i].code + ' ' + data[i].valorComprado + '</td>';
                            item += '<tr><td>Taxa de pagamento:</td><td> R$ ' + data[i].taxaPagamento + '</td>';
                            item += '<tr><td>Taxa de conversão:</td><td> R$ ' + data[i].taxaConversao + '</td>';
                            item += '<tr><td>Valor utilizado para conversão descontando as taxas:</td><td> R$ ' + data[i].valorConversao + '</td>';
                            item += '<tr><td>Data cotação:</td><td> <strong>' + data[i].created_at + '</strong></td>';
                            item += "</tbody>";
                        });


                        $('#consultasAnteriores').append(item);
                    }
                });
            });

            $("#converter").click(function(e) {
                $("#retornoAPI tr").remove();
                var dinheiro = $('#dinheiro').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                e.preventDefault();

                $error = false;

                if (dinheiro === '') {
                    $('#dinheiro').addClass('is-invalid');
                    $error = true;
                    alert('é necessário informar um valor a ser convertido');
                } else if (dinheiro !== '') {
                    $('#dinheiro').removeClass('is-invalid');
                    var compativelComParseFloat = dinheiro.replace(",", ".");
                    var dinheiroConvertido = parseFloat(compativelComParseFloat);
                    if (dinheiroConvertido < 1000) {
                        $('#dinheiro').addClass('is-invalid');
                        $error = true;
                        alert('O valor informado deve ser superior a R$ 1000,00');
                    } else if (dinheiroConvertido > 100000) {
                        $('#dinheiro').addClass('is-invalid');
                        $error = true;
                        alert('O valor informado não pode ser superior a R$ 100.000,00');
                    }
                }

                if ($error == true) {
                    return false;
                }


                var formData = {
                    dinheiro: compativelComParseFloat,
                    moeda: $("#moeda option:selected").val(),
                    formaPagamento: $('input[name=formaPagamento]:checked', '#converteMoeda').val()
                }

                $.ajax({
                    url: "{{ route('converte_moeda') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".messageBox").addClass('d-none');
                    },
                    success: function(data) {
                        if (data.retorno == false) {
                            $(".messageBox").html('Não foi possível converter moeda')
                                .removeClass('d-none')
                                .addClass('alert-danger');
                        } else {
                            var item = "";

                            $.each(data, function(i, items) {
                                item += '<tr><td>Moeda de origem:</td><td> ' + data[i].codein + '</td>';
                                item += '<tr><td>Moeda de destino:</td><td> ' + data[i].code + '</td>';
                                item += '<tr><td>Valor para conversão:</td><td> R$ ' + $('#dinheiro').val() + ' </td>';
                                item += '<tr><td>Forma de pagamento:</td><td> ' + data[i].opcaoContra + '</td>';
                                item += '<tr><td>Valor da "Moeda de destino" usado para conversão:</td><td> R$ ' + data[i].moedaDestino + ' </td>';
                                item += '<tr><td>Valor comprado em "Moeda de destino":</td><td> ' + data[i].code + ' ' + data[i].valorComprado + '</td>';
                                item += '<tr><td>Taxa de pagamento:</td><td> R$ ' + data[i].taxaPagamento + '</td>';
                                item += '<tr><td>Taxa de conversão:</td><td> R$ ' + data[i].taxaConversao + '</td>';
                                item += '<tr><td>Valor utilizado para conversão descontando as taxas:</td><td> R$ ' + data[i].valorConversao + '</td>';
                            });

                            $('#retornoAPI').append(item);
                        }
                    }
                })

            });
        });
    </script>
</div>
@endsection