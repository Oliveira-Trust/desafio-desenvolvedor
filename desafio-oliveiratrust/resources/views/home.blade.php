@extends('layouts.app')

@section('content')



<div class="container mt-4">
    <h2 class="mb-4">Últimas Cotações</h2>
    <div class="text-center">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newCotationModal">
            Nova Cotação
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Moeda de Origem</th>
                    <th>Moeda de Destino</th>
                    <th>Valor para Conversão</th>
                    <th>Valor Total</th>
                    <th>Data da Conversão</th>
                    <th>Visualizar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>Moeda de Origem</td>
                    <td>Moeda de Destino</td>
                    <td>Valor para Conversão</td>
                    <td>Valor Total</td>
                    <td>Data da Conversão</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cotationModal">
                            Visualizar
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Moeda de Origem</td>
                    <td>Moeda de Destino</td>
                    <td>Valor para Conversão</td>
                    <td>Valor Total</td>
                    <td>Data da Conversão</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cotationModal">
                            Visualizar
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Moeda de Origem</td>
                    <td>Moeda de Destino</td>
                    <td>Valor para Conversão</td>
                    <td>Valor Total</td>
                    <td>Data da Conversão</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cotationModal">
                            Visualizar
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Moeda de Origem</td>
                    <td>Moeda de Destino</td>
                    <td>Valor para Conversão</td>
                    <td>Valor Total</td>
                    <td>Data da Conversão</td>
                    <td>
                        <button type="button" class="btn btn-primary cotationButtonView" data-cotation-id="1010" data-bs-toggle="modal" data-bs-target="#cotationModal">
                            Visualizar
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>ID</td>
                    <td>Moeda de Origem</td>
                    <td>Moeda de Destino</td>
                    <td>Valor para Conversão</td>
                    <td>Valor Total</td>
                    <td>Data da Conversão</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cotationModal">
                            Visualizar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="newCotationModal" tabindex="-1" aria-labelledby="newCotationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 mb-4" id="newCotationModalLabel" style="color: #333"><strong>Nova Cotação</strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/cotations" method="post" novalidate >
                @csrf
                    <div class="mb-3">
                        <label for="coin_origin" class="form-label dark-color">Moeda de Origem</label>
                        <select class="form-select " id="coin_origin" name="coin_origin" required>
                            <option value="BRL" selected>BRL - Real Brasileiro</option>
                            <option value="USD">USD - Dólar Americano</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="JPY">JPY - Iene Japonês</option>
                            <div class="invalid-feedback">
                                Por favor, selecione a moeda de origem.
                            </div>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="coin_final" class="form-label dark-color">Moeda de Destino</label>
                        <select class="form-select" id="coin_final" name="coin_final" required>
                            <option value="">Selecione</option>
                            <option value="USD">USD - Dólar Americano</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="JPY">JPY - Iene Japonês</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecione a moeda de destino.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="value_cotation" class="form-label dark-color">Valor para Conversão</label>
                        <input type="number" class="form-control" id="value_cotation" name="value_cotation" placeholder="0.00" step="0.01" min="1000" max="100000">
                    </div>
                    <div class="invalid-feedback">
                        Por favor, insira um valor entre 1000 e 100000.
                    </div>

                    <div class="mb-3">
                        <label for="payment_type" class="form-label dark-color">Forma de Pagamento</label>
                        <select class="form-select" id="payment_type" name="payment_type" required>
                            <option value="">Selecione</option>
                            <option value="boleto">Boleto</option>
                            <option value="cartaoCredito">Cartão de Crédito</option>
                        </select>
                    </div>
                    <div class="invalid-feedback">
                        Por favor, selecione a forma de pagamento.
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Fazer cotação</button>
                        <button type="button" class="btn btn-dark">Enviar por email</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="cotationModal" tabindex="-1" aria-labelledby="cotationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 mb-4 dark-color" id="cotationModalLabel">Cotação <strong>#<span id="cotationIDlabel" data-cotation-id="12345">12345</span></strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td><strong>Moeda de Origem</strong></td>
                            <td id="originCoinLabel"></td>
                        </tr>
                        <tr>
                            <td><strong>Moeda de Destino</strong></td>
                            <td>USD</td>
                        </tr>
                        <tr>
                            <td><strong>Valor para Conversão</strong></td>
                            <td>R$ 5.000</td>
                        </tr>
                        <tr>
                            <td><strong>Forma de Pagamento</strong></td>
                            <td>Boleto</td>
                        </tr>
                        <tr>
                            <td><strong>Valor do USD</strong></td>
                            <td>$ 5,30</td>
                        </tr>
                        <tr>
                            <td><strong>Valor comprado em USD</strong></td>
                            <td>$ 920,18</td>
                        </tr>
                        <tr>
                            <td><strong>Taxa de pagamento</strong></td>
                            <td>R$ 72,50</td>
                        </tr>
                        <tr>
                            <td><strong>Taxa de conversão</strong></td>
                            <td>R$ 50,00</td>
                        </tr>
                        <tr>
                            <td><strong>Valor da Conversão - Taxas</strong></td>
                            <td>R$ 4.877,50</td>
                        </tr>
                        <tr>
                            <td><strong>Data da Conversão</strong></td>
                            <td>09/06/2023 10:33:10</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark">Enviar por Email</button>
            </div>
        </div>
    </div>
</div>

<script type="module">
    $(document).ready(function() {

        $(".cotationButtonView").click(function() {
            // alert($(this).data("cotation-id"));
            $("#cotationIDlabel").text("10");
            $("#originCoinLabel").text("teste");
        });

        $('form').on('submit', function(event) {
            var isValid = true;
            // Verifica se os campos select foram preenchidos
            $('select').each(function() {
                if (!$(this).val()) {
                    $(this).addClass('is-invalid');
                    isValid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Verifica se o valor para conversão está dentro do range
            var value_cotation = $('#value_cotation').val();
            if (value_cotation < 1000 || value_cotation > 100000) {
                $('#value_cotation').addClass('is-invalid');
                isValid = false;
            } else {
                $('#value_cotation').removeClass('is-invalid');
            }

            // Se o formulário não for válido, previne o envio
            if (!isValid) {
                event.preventDefault();
            }
        });

        console.log("its work");
    });
</script>

@endsection